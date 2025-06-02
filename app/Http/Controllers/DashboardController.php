<?php

namespace App\Http\Controllers;

use App\Models\EResep;
use App\Models\EResepDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Antrian;
use App\Models\StokObat;
use App\Models\Riwayat;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = strtolower($user->guard_name ?? 'admin');
        $roleConfig = config("dashboard.roles.{$role}");

        if (!$roleConfig) {
            abort(403, 'Role tidak valid');
        }

        $dashboardData = $this->getDashboardData($roleConfig['permissions']);
        $widgets = $this->getWidgets($roleConfig['widgets'], $dashboardData);

        return view('dashboard.index', compact('widgets', 'role', 'roleConfig'));
    }

    private function getDashboardData($permissions)
    {
        $data = [];

        if (in_array('EResep', $permissions)) {
            $data['EResep'] = [
                'total' => EResep::count(),
                'pending' => EResepDetail::where('status', 'pending')->count(),
                'completed' => EResepDetail::where('status', 'completed')->count(),
                'today' => EResepDetail::whereDate('created_at', today())->count(),
                'recent' => Riwayat::with(['pasien'])->latest()->take(5)->get()
            ];
        }

        if (in_array('stokobat', $permissions)) {
            $data['stokobat'] = [
                'total' => StokObat::count(),
                'low_stock' => StokObat::where('jumlah', '<', 10)->count(),
                'expired_soon' => StokObat::where('expired_date', '<=', now()->addDays(30))->count(),
                'total_value' => StokObat::sum(\DB::raw('jumlah * harga')),
                'recent' => StokObat::latest()->take(5)->get()
            ];
        }

        if (in_array('riwayat', $permissions)) {
            $data['riwayat'] = [
                'total' => Riwayat::count(),
                'today' => Riwayat::whereDate('created_at', today())->count(),
                'this_week' => Riwayat::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
                'this_month' => Riwayat::whereMonth('created_at', now()->month)->count(),
                'recent' => Riwayat::latest()->take(5)->get()
            ];
        }

        if (in_array('user_management', $permissions)) {
            $data['users'] = [
                'total' => User::count(),
                'active' => User::where('is_active', true)->count(),
                'super_admin' => User::where('guard_name', 'super_admin')->count(),
                'petugas' => User::where('guard_name', 'petugas')->count(),
                'admin' => User::where('guard_name', 'admin')->count()
            ];
        }

        return $data;
    }

    private function getWidgets($widgetNames, $data)
    {
        $widgets = [];

        foreach ($widgetNames as $widgetName) {
            switch ($widgetName) {
                case 'antrian_stats':
                    if (isset($data['antrian'])) {
                        $widgets[] = [
                            'type' => 'stat_card',
                            'title' => 'Antrian Pasien',
                            'icon' => 'heroicon-o-users',
                            'color' => 'blue',
                            'stats' => [
                                ['label' => 'Total Antrian', 'value' => $data['antrian']['total']],
                                ['label' => 'Menunggu', 'value' => $data['antrian']['pending']],
                                ['label' => 'Selesai', 'value' => $data['antrian']['completed']],
                                ['label' => 'Hari Ini', 'value' => $data['antrian']['today']]
                            ]
                        ];
                    }
                    break;

                case 'stokobat_stats':
                    if (isset($data['stokobat'])) {
                        $widgets[] = [
                            'type' => 'stat_card',
                            'title' => 'Stok Obat',
                            'icon' => 'heroicon-o-cube',
                            'color' => 'green',
                            'stats' => [
                                ['label' => 'Total Obat', 'value' => $data['stokobat']['total']],
                                ['label' => 'Stok Rendah', 'value' => $data['stokobat']['low_stock'], 'color' => 'warning'],
                                ['label' => 'Akan Expired', 'value' => $data['stokobat']['expired_soon'], 'color' => 'danger'],
                                ['label' => 'Total Nilai', 'value' => 'Rp ' . number_format($data['stokobat']['total_value'])]
                            ]
                        ];
                    }
                    break;

                case 'riwayat_stats':
                    if (isset($data['riwayat'])) {
                        $widgets[] = [
                            'type' => 'stat_card',
                            'title' => 'Riwayat Aktivitas',
                            'icon' => 'heroicon-o-clock',
                            'color' => 'purple',
                            'stats' => [
                                ['label' => 'Total Aktivitas', 'value' => $data['riwayat']['total']],
                                ['label' => 'Hari Ini', 'value' => $data['riwayat']['today']],
                                ['label' => 'Minggu Ini', 'value' => $data['riwayat']['this_week']],
                                ['label' => 'Bulan Ini', 'value' => $data['riwayat']['this_month']]
                            ]
                        ];
                    }
                    break;

                case 'user_stats':
                    if (isset($data['users'])) {
                        $widgets[] = [
                            'type' => 'stat_card',
                            'title' => 'Manajemen User',
                            'icon' => 'heroicon-o-user-group',
                            'color' => 'indigo',
                            'stats' => [
                                ['label' => 'Total User', 'value' => $data['users']['total']],
                                ['label' => 'Super Admin', 'value' => $data['users']['super_admin']],
                                ['label' => 'Petugas', 'value' => $data['users']['petugas']],
                                ['label' => 'Admin', 'value' => $data['users']['admin']]
                            ]
                        ];
                    }
                    break;
            }
        }

        return $widgets;
    }
}
