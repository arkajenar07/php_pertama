<?php
session_start();
include('./database/connection.php');

$query = "SELECT * FROM `pegawai`";
$data = mysqli_query($connection, $query);

$successMsg = '';
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'success') $successMsg = 'Data berhasil ditambahkan!';
    elseif ($_GET['status'] == 'updated') $successMsg = 'Data berhasil diperbarui!';
    elseif ($_GET['status'] == 'deleted') $successMsg = 'Data berhasil dihapus!';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pegawai — Admin Panel</title>
    <meta name="description" content="Halaman admin untuk manajemen data pegawai kantor.">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    animation: {
                        'fade-in': 'fadeIn 0.4s ease-out',
                        'slide-down': 'slideDown 0.4s ease-out',
                    },
                    keyframes: {
                        fadeIn: { '0%': { opacity: '0' }, '100%': { opacity: '1' } },
                        slideDown: { '0%': { opacity: '0', transform: 'translateY(-10px)' }, '100%': { opacity: '1', transform: 'translateY(0)' } },
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
            <a href="admin.php" class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-indigo-600/20 text-indigo-400 text-sm font-medium">
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

        <!-- Top bar -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bold text-white">Data Pegawai Kantor</h1>
                <p class="text-slate-500 text-sm mt-0.5">Kelola seluruh data pegawai</p>
            </div>
            <a href="add.php"
               class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-500 active:scale-95 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-all duration-200 shadow-lg shadow-indigo-500/30">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Data
            </a>
        </div>

        <!-- Toast notification -->
        <?php if ($successMsg): ?>
        <div id="toast" class="mb-6 flex items-center gap-3 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 rounded-xl px-4 py-3 text-sm animate-slide-down">
            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <?php echo htmlspecialchars($successMsg); ?>
        </div>
        <script>setTimeout(()=>{ const t=document.getElementById('toast'); if(t) t.style.display='none'; }, 3500);</script>
        <?php endif; ?>

        <!-- Table Card -->
        <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden shadow-xl animate-fade-in">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-slate-800 bg-slate-800/50">
                            <th class="text-left px-5 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">ID</th>
                            <th class="text-left px-5 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Nama</th>
                            <th class="text-left px-5 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Umur</th>
                            <th class="text-left px-5 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Username</th>
                            <th class="text-left px-5 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Email</th>
                            <th class="text-left px-5 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Password</th>
                            <th class="text-left px-5 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Role</th>
                            <th class="text-left px-5 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                        <?php
                        $count = mysqli_num_rows($data);
                        if ($count == 0): ?>
                        <tr>
                            <td colspan="8" class="text-center py-12 text-slate-500">
                                <svg class="w-10 h-10 mx-auto mb-3 opacity-40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                </svg>
                                Belum ada data pegawai
                            </td>
                        </tr>
                        <?php else: while($row = mysqli_fetch_assoc($data)): ?>
                        <tr class="hover:bg-slate-800/40 transition-colors duration-150">
                            <td class="px-5 py-4 text-slate-400 font-mono text-xs">#<?php echo $row['id']; ?></td>
                            <td class="px-5 py-4 font-medium text-white"><?php echo htmlspecialchars($row['nama']); ?></td>
                            <td class="px-5 py-4 text-slate-300"><?php echo htmlspecialchars($row['umur']); ?></td>
                            <td class="px-5 py-4 text-slate-300"><?php echo htmlspecialchars($row['username']); ?></td>
                            <td class="px-5 py-4 text-slate-300"><?php echo htmlspecialchars($row['email']); ?></td>
                            <td class="px-5 py-4 text-slate-500 font-mono text-xs">••••••••</td>
                            <td class="px-5 py-4">
                                <?php
                                $roleClass = $row['role'] == 'admin'
                                    ? 'bg-violet-500/20 text-violet-400 border-violet-500/30'
                                    : 'bg-sky-500/20 text-sky-400 border-sky-500/30';
                                ?>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border <?php echo $roleClass; ?>">
                                    <?php echo ucfirst(htmlspecialchars($row['role'])); ?>
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="edit.php?id=<?php echo $row['id']; ?>"
                                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-amber-500/10 border border-amber-500/20 text-amber-400 text-xs font-medium hover:bg-amber-500/20 transition-colors duration-200">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </a>
                                    <a href="delete.php?id=<?php echo $row['id']; ?>"
                                       onclick="return confirm('Hapus data <?php echo htmlspecialchars($row['nama']); ?>?')"
                                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-500/10 border border-red-500/20 text-red-400 text-xs font-medium hover:bg-red-500/20 transition-colors duration-200">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</body>
</html>