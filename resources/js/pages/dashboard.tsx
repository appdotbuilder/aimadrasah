import { AppShell } from '@/components/app-shell';
import { Head } from '@inertiajs/react';
import { User, SchoolClass, Subject, Grade, Exam } from '@/types';

interface Props {
    user: User;
    stats: Record<string, number>;
    recentData: Record<string, unknown>;
    [key: string]: unknown;
}

export default function Dashboard({ user, stats, recentData }: Props) {
    const getRoleTitle = (role: string) => {
        const titles = {
            admin: '👨‍💼 Dashboard Administrator',
            teacher: '👩‍🏫 Dashboard Guru',
            student: '👨‍🎓 Dashboard Siswa',
            parent: '👨‍👩‍👧‍👦 Dashboard Orang Tua',
        };
        return titles[role as keyof typeof titles] || 'Dashboard';
    };

    const getRoleGreeting = (role: string, name: string) => {
        const greetings = {
            admin: `Selamat datang kembali, ${name}! 🚀`,
            teacher: `Halo Guru ${name}! Semangat mengajar! 📚`,
            student: `Halo ${name}! Semangat belajar! 🎯`,
            parent: `Halo ${name}! Mari pantau perkembangan anak. 💖`,
        };
        return greetings[role as keyof typeof greetings] || `Halo ${name}!`;
    };

    return (
        <AppShell>
            <Head title={getRoleTitle(user.role)} />
            
            <div className="space-y-6">
                {/* Header */}
                <div className="rounded-lg bg-gradient-to-r from-emerald-500 to-blue-500 p-6 text-white">
                    <h1 className="text-2xl font-bold text-white">{getRoleTitle(user.role)}</h1>
                    <p className="mt-2 text-emerald-100">
                        {getRoleGreeting(user.role, user.name)}
                    </p>
                </div>

                {/* Stats Cards */}
                <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    {Object.entries(stats).map(([key, value]) => (
                        <div key={key} className="rounded-lg bg-white p-6 shadow dark:bg-gray-800">
                            <div className="flex items-center">
                                <div className="flex-1">
                                    <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                                        {formatStatKey(key)}
                                    </p>
                                    <p className="text-2xl font-bold text-gray-900 dark:text-white">
                                        {typeof value === 'number' ? value.toLocaleString() : value}
                                    </p>
                                </div>
                                <div className="ml-4 text-2xl">
                                    {getStatIcon(key)}
                                </div>
                            </div>
                        </div>
                    ))}
                </div>

                {/* Role-specific Content */}
                {user.role === 'admin' && (
                    <div className="grid grid-cols-1 gap-6 lg:grid-cols-2">
                        {/* Recent Users */}
                        <div className="rounded-lg bg-white p-6 shadow dark:bg-gray-800">
                            <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                👥 Pengguna Terbaru
                            </h3>
                            <div className="space-y-3">
                                {(recentData.recent_users as User[])?.slice(0, 5).map((user: User) => (
                                    <div key={user.id} className="flex items-center space-x-3">
                                        <div className="h-8 w-8 rounded-full bg-emerald-100 flex items-center justify-center dark:bg-emerald-900">
                                            <span className="text-sm font-medium text-emerald-600 dark:text-emerald-400">
                                                {user.name.charAt(0)}
                                            </span>
                                        </div>
                                        <div className="flex-1">
                                            <p className="text-sm font-medium text-gray-900 dark:text-white">
                                                {user.name}
                                            </p>
                                            <p className="text-xs text-gray-500 dark:text-gray-400">
                                                {user.role} • {user.email}
                                            </p>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        </div>

                        {/* Recent Notifications */}
                        <div className="rounded-lg bg-white p-6 shadow dark:bg-gray-800">
                            <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                🔔 Notifikasi Terbaru
                            </h3>
                            <div className="space-y-3">
                                {(recentData.recent_notifications as Array<{id: number, title: string, message: string}>)?.slice(0, 5).map((notification) => (
                                    <div key={notification.id} className="border-l-4 border-emerald-400 pl-3">
                                        <p className="text-sm font-medium text-gray-900 dark:text-white">
                                            {notification.title}
                                        </p>
                                        <p className="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                            {notification.message.substring(0, 60)}...
                                        </p>
                                    </div>
                                ))}
                            </div>
                        </div>
                    </div>
                )}

                {user.role === 'teacher' && (
                    <div className="grid grid-cols-1 gap-6 lg:grid-cols-2">
                        {/* My Classes */}
                        <div className="rounded-lg bg-white p-6 shadow dark:bg-gray-800">
                            <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                🏫 Kelas Saya
                            </h3>
                            <div className="space-y-3">
                                {(recentData.my_classes as SchoolClass[])?.map((schoolClass) => (
                                    <div key={schoolClass.id} className="flex items-center justify-between p-3 rounded-lg bg-gray-50 dark:bg-gray-700">
                                        <div>
                                            <p className="text-sm font-medium text-gray-900 dark:text-white">
                                                {schoolClass.name}
                                            </p>
                                            <p className="text-xs text-gray-500 dark:text-gray-400">
                                                Grade {schoolClass.grade} • {schoolClass.capacity} siswa
                                            </p>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        </div>

                        {/* Teaching Subjects */}
                        <div className="rounded-lg bg-white p-6 shadow dark:bg-gray-800">
                            <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                📚 Mata Pelajaran
                            </h3>
                            <div className="space-y-3">
                                {(recentData.teaching_subjects as Array<{id: number, subject?: Subject, class?: SchoolClass, schedule_day?: string}>)?.slice(0, 5).map((classSubject) => (
                                    <div key={classSubject.id} className="flex items-center justify-between p-3 rounded-lg bg-gray-50 dark:bg-gray-700">
                                        <div>
                                            <p className="text-sm font-medium text-gray-900 dark:text-white">
                                                {classSubject.subject?.name}
                                            </p>
                                            <p className="text-xs text-gray-500 dark:text-gray-400">
                                                {classSubject.class?.name} • {classSubject.schedule_day}
                                            </p>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        </div>
                    </div>
                )}

                {user.role === 'student' && (
                    <div className="grid grid-cols-1 gap-6 lg:grid-cols-2">
                        {/* Recent Grades */}
                        <div className="rounded-lg bg-white p-6 shadow dark:bg-gray-800">
                            <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                📊 Nilai Terbaru
                            </h3>
                            <div className="space-y-3">
                                {(recentData.recent_grades as Grade[])?.map((grade) => (
                                    <div key={grade.id} className="flex items-center justify-between p-3 rounded-lg bg-gray-50 dark:bg-gray-700">
                                        <div>
                                            <p className="text-sm font-medium text-gray-900 dark:text-white">
                                                {grade.subject?.name}
                                            </p>
                                            <p className="text-xs text-gray-500 dark:text-gray-400">
                                                {grade.assessment_name} • {grade.teacher?.name}
                                            </p>
                                        </div>
                                        <div className="text-right">
                                            <p className="text-lg font-bold text-emerald-600 dark:text-emerald-400">
                                                {grade.score}/{grade.max_score}
                                            </p>
                                            <p className="text-xs text-gray-500 dark:text-gray-400">
                                                {grade.percentage}%
                                            </p>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        </div>

                        {/* Upcoming Exams */}
                        <div className="rounded-lg bg-white p-6 shadow dark:bg-gray-800">
                            <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                📝 Ujian Mendatang
                            </h3>
                            <div className="space-y-3">
                                {(recentData.upcoming_exams as Exam[])?.map((exam) => (
                                    <div key={exam.id} className="flex items-center justify-between p-3 rounded-lg bg-blue-50 dark:bg-blue-900/20">
                                        <div>
                                            <p className="text-sm font-medium text-gray-900 dark:text-white">
                                                {exam.title}
                                            </p>
                                            <p className="text-xs text-gray-500 dark:text-gray-400">
                                                {new Date(exam.start_time).toLocaleDateString('id-ID')}
                                            </p>
                                        </div>
                                        <div className="text-right">
                                            <p className="text-xs text-blue-600 dark:text-blue-400 font-medium">
                                                {exam.duration} menit
                                            </p>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        </div>
                    </div>
                )}

                {user.role === 'parent' && (
                    <div className="grid grid-cols-1 gap-6 lg:grid-cols-2">
                        {/* Children */}
                        <div className="rounded-lg bg-white p-6 shadow dark:bg-gray-800">
                            <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                👶 Anak-anak
                            </h3>
                            <div className="space-y-3">
                                {(recentData.children as User[])?.map((child) => (
                                    <div key={child.id} className="flex items-center space-x-3 p-3 rounded-lg bg-gray-50 dark:bg-gray-700">
                                        <div className="h-10 w-10 rounded-full bg-emerald-100 flex items-center justify-center dark:bg-emerald-900">
                                            <span className="text-sm font-medium text-emerald-600 dark:text-emerald-400">
                                                {child.name.charAt(0)}
                                            </span>
                                        </div>
                                        <div>
                                            <p className="text-sm font-medium text-gray-900 dark:text-white">
                                                {child.name}
                                            </p>
                                            <p className="text-xs text-gray-500 dark:text-gray-400">
                                                ID: {child.student_id}
                                            </p>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        </div>

                        {/* Recent Grades */}
                        <div className="rounded-lg bg-white p-6 shadow dark:bg-gray-800">
                            <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                📊 Nilai Terbaru Anak
                            </h3>
                            <div className="space-y-3">
                                {(recentData.recent_grades as Grade[])?.slice(0, 5).map((grade) => (
                                    <div key={grade.id} className="flex items-center justify-between p-3 rounded-lg bg-gray-50 dark:bg-gray-700">
                                        <div>
                                            <p className="text-sm font-medium text-gray-900 dark:text-white">
                                                {grade.student?.name} - {grade.subject?.name}
                                            </p>
                                            <p className="text-xs text-gray-500 dark:text-gray-400">
                                                {grade.assessment_name}
                                            </p>
                                        </div>
                                        <div className="text-right">
                                            <p className="text-lg font-bold text-emerald-600 dark:text-emerald-400">
                                                {grade.score}/{grade.max_score}
                                            </p>
                                            <p className="text-xs text-gray-500 dark:text-gray-400">
                                                {grade.percentage}%
                                            </p>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        </div>
                    </div>
                )}

                {/* Quick Actions */}
                <div className="rounded-lg bg-white p-6 shadow dark:bg-gray-800">
                    <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        ⚡ Aksi Cepat
                    </h3>
                    <div className="grid grid-cols-2 gap-4 sm:grid-cols-4">
                        {getQuickActions(user.role).map((action, index) => (
                            <button
                                key={index}
                                className="flex flex-col items-center justify-center rounded-lg border-2 border-dashed border-gray-300 p-4 text-center hover:border-emerald-500 hover:bg-emerald-50 dark:border-gray-600 dark:hover:border-emerald-500 dark:hover:bg-emerald-900/20 transition-colors"
                            >
                                <span className="text-2xl mb-2">{action.icon}</span>
                                <span className="text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {action.label}
                                </span>
                            </button>
                        ))}
                    </div>
                </div>
            </div>
        </AppShell>
    );
}

function formatStatKey(key: string): string {
    const labels: Record<string, string> = {
        total_users: 'Total Pengguna',
        total_teachers: 'Total Guru',
        total_students: 'Total Siswa',
        total_parents: 'Total Orang Tua',
        total_classes: 'Total Kelas',
        total_subjects: 'Total Mata Pelajaran',
        active_exams: 'Ujian Aktif',
        my_classes: 'Kelas Saya',
        my_subjects: 'Mata Pelajaran',
        total_children: 'Total Anak',
        total_grades: 'Total Nilai',
        recent_grades: 'Nilai Terbaru',
        recent_attendance: 'Kehadiran Minggu Ini',
        attendance_rate: 'Tingkat Kehadiran (%)',
        pending_grades: 'Nilai Pending',
    };
    return labels[key] || key.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
}

function getStatIcon(key: string): string {
    const icons: Record<string, string> = {
        total_users: '👥',
        total_teachers: '👩‍🏫',
        total_students: '👨‍🎓',
        total_parents: '👨‍👩‍👧‍👦',
        total_classes: '🏫',
        total_subjects: '📚',
        active_exams: '📝',
        my_classes: '🏫',
        my_subjects: '📚',
        total_children: '👶',
        total_grades: '📊',
        recent_grades: '📈',
        recent_attendance: '📋',
        attendance_rate: '📊',
        pending_grades: '⏳',
    };
    return icons[key] || '📊';
}

function getQuickActions(role: string) {
    const actions: Record<string, Array<{icon: string, label: string}>> = {
        admin: [
            { icon: '👤', label: 'Kelola Pengguna' },
            { icon: '🏫', label: 'Kelola Kelas' },
            { icon: '📚', label: 'Kelola Mata Pelajaran' },
            { icon: '📊', label: 'Laporan Sistem' },
        ],
        teacher: [
            { icon: '📋', label: 'Catat Absensi' },
            { icon: '📊', label: 'Input Nilai' },
            { icon: '📚', label: 'Upload Materi' },
            { icon: '📝', label: 'Buat Ujian' },
        ],
        student: [
            { icon: '📚', label: 'Materi Pembelajaran' },
            { icon: '📝', label: 'Ujian Saya' },
            { icon: '📊', label: 'Lihat Nilai' },
            { icon: '📅', label: 'Jadwal Kelas' },
        ],
        parent: [
            { icon: '📊', label: 'Nilai Anak' },
            { icon: '📋', label: 'Kehadiran Anak' },
            { icon: '💬', label: 'Chat Guru' },
            { icon: '📄', label: 'Rapor Digital' },
        ],
    };
    return actions[role] || [];
}