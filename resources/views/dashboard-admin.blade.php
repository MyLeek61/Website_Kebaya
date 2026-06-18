@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Admin Dashboard Overview</h2>

    <div class="chart-card-box">
        <h3>Analisis UX Overview</h3>
        <p>Rata-rata skor kepuasan responden berdasarkan metrik UX.</p>
        <div class="chart-container-wrapper" style="height: 300px;">
            <canvas id="uxBarChart"></canvas>
        </div>
        <div class="chart-footer-label" style="text-align: center; margin-top: 15px; font-style: italic; color: #7a4a35;">
            <span>Statistik: <strong>Mean (Rata-rata Skor Responden)</strong></span>
        </div>
    </div>
    <div class="chart-card-box">
        <h3>Analisis UX (Nilai Tengah)</h3>
        <p>Visualisasi nilai median dari respons pengguna untuk setiap aspek UX.</p>
        
        <div class="chart-container-wrapper" style="height: 300px;">
            <canvas id="uxMedianChart"></canvas>
        </div>

        <div style="text-align: center; margin-top: 15px; color: #7a4a35;">
            <p>Statistik: <strong>Median (Nilai Tengah dari Seluruh Responden)</strong></p>
        </div>
    </div>
    <div class="chart-card-box">
        <h3>Analisis UX (Standar Deviasi)</h3>
        <p>Mengukur konsistensi jawaban responden (semakin rendah, semakin konsisten).</p>
        
        <div class="chart-container-wrapper" style="height: 300px;">
            <canvas id="uxStdDevChart"></canvas>
        </div>

        <div style="text-align: center; margin-top: 15px; color: #7a4a35;">
            <p>Statistik: <strong>Standard Deviation (Variasi Skor)</strong></p>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Chart 1: Mean
    const ctxBar = document.getElementById('uxBarChart').getContext('2d');
    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: ['Kemudahan', 'Kejelasan', 'Daya Tarik', 'Kecepatan', 'Kebergunaan'],
            datasets: [{
                label: 'Skor Rata-rata (1-5)',
                data: [
                    {{ $avgUx->avg_kemudahan ?? 0 }},
                    {{ $avgUx->avg_kejelasan ?? 0 }},
                    {{ $avgUx->avg_dayatarik ?? 0 }},
                    {{ $avgUx->avg_kecepatan ?? 0 }},
                    {{ $avgUx->avg_kebergunaan ?? 0 }}
                ],
                backgroundColor: '#cfa381',
                borderRadius: 8
            }]
        },
        options: { /* ... opsi Anda ... */ }
    });

    // Chart 2: Median (Gunakan nama variabel berbeda: ctxMedian)
    const ctxMedian = document.getElementById('uxMedianChart').getContext('2d');
    new Chart(ctxMedian, {
        type: 'bar',
        data: {
            labels: ['Kemudahan', 'Kejelasan', 'Daya Tarik', 'Kecepatan', 'Kebergunaan'],
            datasets: [{
                label: 'Skor Median (1-5)',
                data: [
                    {{ $medianUx['kemudahan'] }},
                    {{ $medianUx['kejelasan'] }},
                    {{ $medianUx['dayatarik'] }},
                    {{ $medianUx['kecepatan'] }},
                    {{ $medianUx['kebergunaan'] }}
                ],
                backgroundColor: '#7a4a35',
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true, max: 5, ticks: { stepSize: 1 } }
            }
        }
    });
    
    const ctxStd = document.getElementById('uxStdDevChart').getContext('2d');
    new Chart(ctxStd, {
        type: 'bar',
        data: {
            labels: ['Kemudahan', 'Kejelasan', 'Daya Tarik', 'Kecepatan', 'Kebergunaan'],
            datasets: [{
                label: 'Skor Standar Deviasi',
                data: [
                    {{ $stdDevUx['kemudahan'] }},
                    {{ $stdDevUx['kejelasan'] }},
                    {{ $stdDevUx['dayatarik'] }},
                    {{ $stdDevUx['kecepatan'] }},
                    {{ $stdDevUx['kebergunaan'] }}
                ],
                backgroundColor: '#e4d2be', // Warna lebih terang untuk membedakan
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true, max: 2 } // Standar deviasi biasanya tidak lebih dari 2 untuk skala 1-5
            }
        }
    });
</script>
</script>
@endsection