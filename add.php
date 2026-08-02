<?php
session_start();
include('./database/connection.php');

if (isset($_POST['submit'])){
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $query = "INSERT INTO `pegawai`(`nama`, `umur`, `username`, `email`, `password`, `role`) VALUES ('$nama','$umur','$username','$email','$password','$role')";

    mysqli_query($connection, $query);

    header("Location: admin.php?status=success");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Pegawai — Admin Panel</title>
    <meta name="description" content="Form tambah data pegawai baru ke sistem.">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    animation: { 'slide-up': 'slideUp 0.5s ease-out' },
                    keyframes: {
                        slideUp: { '0%': { opacity: '0', transform: 'translateY(16px)' }, '100%': { opacity: '1', transform: 'translateY(0)' } },
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="font-sans min-h-screen bg-slate-950 text-slate-100">

    <!-- Sidebar -->
    <aside class="fixed left-0 top-0 h-full w-60 bg-slate-900 border-r border-slate-800 flex flex-col z-20">
        <div class="flex items-center gap-3 px-6 py-5 border-b border-slate-800">
            <div class="w-9 h-9 rounded-xl bg-indigo-600 flex items-center justify-center shadow-lg shadow-indigo-500/30">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-bold text-white">Admin Panel</p>
                <p class="text-xs text-slate-500">Sistem Pegawai</p>
            </div>
        </div>
        <nav class="flex-1 px-3 py-4 space-y-1">
            <a href="admin.php" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 text-sm transition-colors duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Data Pegawai
            </a>
        </nav>
        <div class="px-3 py-4 border-t border-slate-800">
            <a href="index.php" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:text-red-400 hover:bg-red-500/10 text-sm transition-colors duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Keluar
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="ml-60 p-8 min-h-screen">

        <div class="max-w-2xl animate-slide-up">

            <!-- Header -->
            <div class="flex items-center gap-4 mb-8">
                <a href="admin.php" class="p-2 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-white">Tambah Data Pegawai</h1>
                    <p class="text-slate-500 text-sm mt-0.5">Isi formulir untuk menambah pegawai baru</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-xl">
                <form action="" method="post" class="space-y-5">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- Nama -->
                        <div class="sm:col-span-2">
                            <label for="nama" class="block text-sm font-medium text-slate-300 mb-1.5">Nama Lengkap</label>
                            <input type="text" id="nama" name="nama" required placeholder="Contoh: Budi Santoso"
                                class="w-full bg-slate-800 border border-slate-700 text-white placeholder-slate-500 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 hover:border-slate-600">
                        </div>

                        <!-- Umur -->
                        <div>
                            <label for="umur" class="block text-sm font-medium text-slate-300 mb-1.5">Umur</label>
                            <input type="number" id="umur" name="umur" required placeholder="25" min="17" max="99"
                                class="w-full bg-slate-800 border border-slate-700 text-white placeholder-slate-500 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 hover:border-slate-600">
                        </div>

                        <!-- Username -->
                        <div>
                            <label for="username" class="block text-sm font-medium text-slate-300 mb-1.5">Username</label>
                            <input type="text" id="username" name="username" required placeholder="budi_santoso"
                                class="w-full bg-slate-800 border border-slate-700 text-white placeholder-slate-500 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 hover:border-slate-600">
                        </div>

                        <!-- Email -->
                        <div class="sm:col-span-2">
                            <label for="email" class="block text-sm font-medium text-slate-300 mb-1.5">Email</label>
                            <input type="email" id="email" name="email" required placeholder="budi@email.com"
                                class="w-full bg-slate-800 border border-slate-700 text-white placeholder-slate-500 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 hover:border-slate-600">
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-slate-300 mb-1.5">Password</label>
                            <input type="password" id="password" name="password" required placeholder="••••••••"
                                class="w-full bg-slate-800 border border-slate-700 text-white placeholder-slate-500 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 hover:border-slate-600">
                        </div>

                        <!-- Role -->
                        <div>
                            <label for="role" class="block text-sm font-medium text-slate-300 mb-1.5">Role</label>
                            <select id="role" name="role" required
                                class="w-full bg-slate-800 border border-slate-700 text-white rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 hover:border-slate-600 appearance-none">
                                <option value="" disabled selected class="text-slate-500">Pilih role...</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-3 pt-2 border-t border-slate-800">
                        <button type="submit" name="submit"
                            class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-500 active:scale-95 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition-all duration-200 shadow-lg shadow-indigo-500/30">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            Simpan Data
                        </button>
                        <a href="admin.php"
                           class="inline-flex items-center gap-2 bg-slate-800 hover:bg-slate-700 active:scale-95 text-slate-300 text-sm font-medium px-5 py-2.5 rounded-xl transition-all duration-200 border border-slate-700">
                            Batal
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </main>
</body>
</html>