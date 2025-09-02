import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <Head title="AI Madrasah - Sistem Manajemen Sekolah Modern">
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
            </Head>
            <div className="flex min-h-screen flex-col bg-gradient-to-br from-emerald-50 to-blue-50 dark:from-gray-900 dark:to-gray-800">
                {/* Header */}
                <header className="w-full border-b border-emerald-200 bg-white/80 backdrop-blur-sm dark:border-gray-700 dark:bg-gray-900/80">
                    <div className="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                        <div className="flex items-center space-x-3">
                            <div className="flex h-10 w-10 items-center justify-center rounded-lg bg-gradient-to-br from-emerald-500 to-blue-500 text-white">
                                <span className="text-xl font-bold">🎓</span>
                            </div>
                            <div>
                                <h1 className="text-xl font-bold text-gray-900 dark:text-white">AI Madrasah</h1>
                                <p className="text-sm text-gray-600 dark:text-gray-400">Sistem Manajemen Sekolah</p>
                            </div>
                        </div>
                        <nav className="flex items-center space-x-4">
                            {auth.user ? (
                                <Link
                                    href={route('dashboard')}
                                    className="inline-flex items-center rounded-lg border border-transparent bg-emerald-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2"
                                >
                                    Dashboard
                                </Link>
                            ) : (
                                <>
                                    <Link
                                        href={route('login')}
                                        className="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700"
                                    >
                                        Masuk
                                    </Link>
                                    <Link
                                        href={route('register')}
                                        className="inline-flex items-center rounded-lg border border-transparent bg-emerald-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2"
                                    >
                                        Daftar
                                    </Link>
                                </>
                            )}
                        </nav>
                    </div>
                </header>

                {/* Main Content */}
                <main className="flex-1">
                    {/* Hero Section */}
                    <div className="relative overflow-hidden">
                        <div className="mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-24 lg:px-8">
                            <div className="text-center">
                                <h1 className="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl md:text-6xl dark:text-white">
                                    <span className="block">🏫 AI Madrasah</span>
                                    <span className="mt-2 block text-emerald-600 dark:text-emerald-400">
                                        Platform Manajemen Sekolah Modern
                                    </span>
                                </h1>
                                <p className="mx-auto mt-6 max-w-2xl text-lg leading-8 text-gray-600 dark:text-gray-300">
                                    Solusi lengkap untuk mengelola sekolah dengan teknologi AI. Memudahkan admin, guru, siswa, dan orang tua dalam menjalankan aktivitas pendidikan sehari-hari.
                                </p>
                                <div className="mt-10 flex items-center justify-center gap-x-6">
                                    {!auth.user ? (
                                        <>
                                            <Link
                                                href={route('register')}
                                                className="inline-flex items-center rounded-lg bg-emerald-600 px-6 py-3 text-base font-semibold text-white shadow-sm hover:bg-emerald-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600"
                                            >
                                                Mulai Sekarang
                                                <span className="ml-2">🚀</span>
                                            </Link>
                                            <Link
                                                href={route('login')}
                                                className="text-base font-semibold leading-6 text-gray-900 hover:text-emerald-600 dark:text-white dark:hover:text-emerald-400"
                                            >
                                                Sudah punya akun? Masuk <span aria-hidden="true">→</span>
                                            </Link>
                                        </>
                                    ) : (
                                        <Link
                                            href={route('dashboard')}
                                            className="inline-flex items-center rounded-lg bg-emerald-600 px-6 py-3 text-base font-semibold text-white shadow-sm hover:bg-emerald-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600"
                                        >
                                            Buka Dashboard
                                            <span className="ml-2">📊</span>
                                        </Link>
                                    )}
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* Features Section */}
                    <div className="bg-white py-16 sm:py-24 dark:bg-gray-800">
                        <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                            <div className="text-center">
                                <h2 className="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl dark:text-white">
                                    ✨ Fitur Unggulan
                                </h2>
                                <p className="mt-4 text-lg text-gray-600 dark:text-gray-300">
                                    Semua yang Anda butuhkan untuk mengelola madrasah modern
                                </p>
                            </div>

                            <div className="mt-16 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                                {/* User Management */}
                                <div className="relative rounded-2xl bg-gray-50 p-6 transition-all hover:shadow-lg dark:bg-gray-700">
                                    <div className="flex h-12 w-12 items-center justify-center rounded-lg bg-emerald-100 text-2xl dark:bg-emerald-900">
                                        👥
                                    </div>
                                    <h3 className="mt-4 text-lg font-semibold text-gray-900 dark:text-white">
                                        Manajemen Pengguna
                                    </h3>
                                    <p className="mt-2 text-sm text-gray-600 dark:text-gray-300">
                                        Kelola admin, guru, siswa, dan orang tua dengan sistem peran yang jelas dan terstruktur.
                                    </p>
                                </div>

                                {/* Attendance */}
                                <div className="relative rounded-2xl bg-gray-50 p-6 transition-all hover:shadow-lg dark:bg-gray-700">
                                    <div className="flex h-12 w-12 items-center justify-center rounded-lg bg-blue-100 text-2xl dark:bg-blue-900">
                                        📋
                                    </div>
                                    <h3 className="mt-4 text-lg font-semibold text-gray-900 dark:text-white">
                                        Sistem Absensi
                                    </h3>
                                    <p className="mt-2 text-sm text-gray-600 dark:text-gray-300">
                                        Catat kehadiran siswa dengan mudah dan dapatkan laporan kehadiran yang akurat.
                                    </p>
                                </div>

                                {/* Learning Materials */}
                                <div className="relative rounded-2xl bg-gray-50 p-6 transition-all hover:shadow-lg dark:bg-gray-700">
                                    <div className="flex h-12 w-12 items-center justify-center rounded-lg bg-purple-100 text-2xl dark:bg-purple-900">
                                        📚
                                    </div>
                                    <h3 className="mt-4 text-lg font-semibold text-gray-900 dark:text-white">
                                        Materi Pembelajaran
                                    </h3>
                                    <p className="mt-2 text-sm text-gray-600 dark:text-gray-300">
                                        Upload dan kelola berbagai materi pembelajaran (PDF, PPT, Video, Link).
                                    </p>
                                </div>

                                {/* Exams */}
                                <div className="relative rounded-2xl bg-gray-50 p-6 transition-all hover:shadow-lg dark:bg-gray-700">
                                    <div className="flex h-12 w-12 items-center justify-center rounded-lg bg-red-100 text-2xl dark:bg-red-900">
                                        📝
                                    </div>
                                    <h3 className="mt-4 text-lg font-semibold text-gray-900 dark:text-white">
                                        Ujian Online
                                    </h3>
                                    <p className="mt-2 text-sm text-gray-600 dark:text-gray-300">
                                        Buat ujian online dengan soal pilihan ganda, esai, dan fitur anti-kecurangan.
                                    </p>
                                </div>

                                {/* Reports */}
                                <div className="relative rounded-2xl bg-gray-50 p-6 transition-all hover:shadow-lg dark:bg-gray-700">
                                    <div className="flex h-12 w-12 items-center justify-center rounded-lg bg-yellow-100 text-2xl dark:bg-yellow-900">
                                        📊
                                    </div>
                                    <h3 className="mt-4 text-lg font-semibold text-gray-900 dark:text-white">
                                        Laporan & Analisis
                                    </h3>
                                    <p className="mt-2 text-sm text-gray-600 dark:text-gray-300">
                                        Rapor digital, grafik perkembangan, dan ekspor data ke Excel/PDF.
                                    </p>
                                </div>

                                {/* Notifications */}
                                <div className="relative rounded-2xl bg-gray-50 p-6 transition-all hover:shadow-lg dark:bg-gray-700">
                                    <div className="flex h-12 w-12 items-center justify-center rounded-lg bg-teal-100 text-2xl dark:bg-teal-900">
                                        🔔
                                    </div>
                                    <h3 className="mt-4 text-lg font-semibold text-gray-900 dark:text-white">
                                        Notifikasi & Chat
                                    </h3>
                                    <p className="mt-2 text-sm text-gray-600 dark:text-gray-300">
                                        Sistem notifikasi otomatis dan komunikasi internal antar pengguna.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* User Roles Section */}
                    <div className="bg-emerald-50 py-16 sm:py-24 dark:bg-gray-900">
                        <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                            <div className="text-center">
                                <h2 className="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl dark:text-white">
                                    🎯 Untuk Semua Pengguna
                                </h2>
                                <p className="mt-4 text-lg text-gray-600 dark:text-gray-300">
                                    Setiap peran memiliki akses dan fitur yang disesuaikan dengan kebutuhan
                                </p>
                            </div>

                            <div className="mt-16 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
                                <div className="text-center">
                                    <div className="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-red-100 text-3xl dark:bg-red-900">
                                        👨‍💼
                                    </div>
                                    <h3 className="mt-4 text-lg font-semibold text-gray-900 dark:text-white">Admin</h3>
                                    <p className="mt-2 text-sm text-gray-600 dark:text-gray-300">
                                        Kelola seluruh sistem, pengguna, dan hak akses
                                    </p>
                                </div>

                                <div className="text-center">
                                    <div className="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 text-3xl dark:bg-blue-900">
                                        👩‍🏫
                                    </div>
                                    <h3 className="mt-4 text-lg font-semibold text-gray-900 dark:text-white">Guru</h3>
                                    <p className="mt-2 text-sm text-gray-600 dark:text-gray-300">
                                        Input nilai, absensi, upload materi, dan buat ujian
                                    </p>
                                </div>

                                <div className="text-center">
                                    <div className="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-green-100 text-3xl dark:bg-green-900">
                                        👨‍🎓
                                    </div>
                                    <h3 className="mt-4 text-lg font-semibold text-gray-900 dark:text-white">Siswa</h3>
                                    <p className="mt-2 text-sm text-gray-600 dark:text-gray-300">
                                        Akses jadwal, materi, nilai, dan ikuti ujian
                                    </p>
                                </div>

                                <div className="text-center">
                                    <div className="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-purple-100 text-3xl dark:bg-purple-900">
                                        👨‍👩‍👧‍👦
                                    </div>
                                    <h3 className="mt-4 text-lg font-semibold text-gray-900 dark:text-white">Orang Tua</h3>
                                    <p className="mt-2 text-sm text-gray-600 dark:text-gray-300">
                                        Pantau perkembangan akademik dan kehadiran anak
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* CTA Section */}
                    <div className="bg-emerald-600">
                        <div className="mx-auto max-w-2xl px-4 py-16 text-center sm:px-6 sm:py-20 lg:px-8">
                            <h2 className="text-3xl font-bold tracking-tight text-white sm:text-4xl">
                                <span className="block">Siap untuk memulai?</span>
                                <span className="block">🚀 Demo Login:</span>
                            </h2>
                            <div className="mt-8 space-y-2 text-emerald-100">
                                <p className="text-lg font-semibold">Admin: admin@aimadrasah.com / admin123</p>
                                <p className="text-sm">Atau daftar sebagai pengguna baru untuk mencoba fitur lengkap</p>
                            </div>
                            <div className="mt-8 flex items-center justify-center gap-x-6">
                                {!auth.user ? (
                                    <>
                                        <Link
                                            href={route('login')}
                                            className="inline-flex items-center rounded-lg bg-white px-6 py-3 text-base font-semibold text-emerald-600 shadow-sm hover:bg-emerald-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white"
                                        >
                                            Coba Demo
                                        </Link>
                                        <Link
                                            href={route('register')}
                                            className="inline-flex items-center rounded-lg border border-white px-6 py-3 text-base font-semibold text-white hover:bg-emerald-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white"
                                        >
                                            Daftar Gratis
                                        </Link>
                                    </>
                                ) : (
                                    <Link
                                        href={route('dashboard')}
                                        className="inline-flex items-center rounded-lg bg-white px-6 py-3 text-base font-semibold text-emerald-600 shadow-sm hover:bg-emerald-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white"
                                    >
                                        Buka Dashboard
                                    </Link>
                                )}
                            </div>
                        </div>
                    </div>
                </main>

                {/* Footer */}
                <footer className="border-t border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
                    <div className="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
                        <div className="flex items-center justify-between">
                            <div className="flex items-center space-x-3">
                                <div className="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-emerald-500 to-blue-500 text-white">
                                    <span className="text-sm font-bold">🎓</span>
                                </div>
                                <span className="text-sm font-semibold text-gray-900 dark:text-white">AI Madrasah</span>
                            </div>
                            <p className="text-sm text-gray-600 dark:text-gray-400">
                                © 2024 AI Madrasah. Platform pendidikan modern untuk semua.
                            </p>
                        </div>
                    </div>
                </footer>
            </div>
        </>
    );
}