<?php

namespace App\Services;

use Phpml\Classification\DecisionTree;
use Phpml\ModelManager;
use Phpml\Dataset\ArrayDataset;
use Illuminate\Support\Facades\Log;

class DecisionTreeService
{
    // Properti untuk menyimpan classifier dan file model
    protected $classifier;
    protected $modelFile = 'decision_tree_model.phpml';

    // Konstruktor untuk mencoba memuat model yang sudah ada atau membuat classifier baru
    public function __construct()
    {
        // Jika file model ada, maka muat model dari file
        if (file_exists(storage_path($this->modelFile))) {
            $this->classifier = (new ModelManager())->restoreFromFile(storage_path($this->modelFile));
        } else {
            // Jika tidak ada, buat classifier baru
            $this->classifier = new DecisionTree();
        }
    }

    // Metode untuk melatih classifier dengan data sampel dan label
    public function train(array $samples, array $labels)
    {
        // Buat dataset dari sampel dan label
        $dataset = new ArrayDataset($samples, $labels);
        
        // Latih classifier dengan data sampel dan target
        $this->classifier->train($dataset->getSamples(), $dataset->getTargets());

        // Simpan model yang telah dilatih ke file
        (new ModelManager())->saveToFile($this->classifier, storage_path($this->modelFile));
    }

    // Metode untuk memprediksi hasil berdasarkan sampel yang diberikan
    public function predict(array $sample)
    {
        try {
            // Prediksi hasil dengan classifier
            return $this->classifier->predict($sample);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, catat ke log dan kembalikan null
            Log::error('Prediction error: ' . $e->getMessage());
            return null;
        }
    }

    // Metode untuk mengevaluasi kriteria dan memutuskan apakah memenuhi syarat
    public function evaluateCriteria($masyarakat)
    {
        // Format data masyarakat menjadi sampel yang sesuai untuk prediksi
        $sample = [
            $masyarakat->saudara,
            $masyarakat->jumlah_anak,
            $masyarakat->biaya_kebutuhan_tiap_bulan + ($masyarakat->biaya_sekolah_anak ?? 0),
            $masyarakat->pendapatan_keluarga,
            $masyarakat->status_tempat_tinggal === 'ngontrak' ? 1 : 0
        ];

        // Prediksi apakah sampel memenuhi kriteria
        return $this->predict($sample);
    }
}
