<?php
namespace App\Services;

class TreeNode {
    // Node pada pohon keputusan
    public $attribute;   // Atribut yang digunakan untuk split
    public $threshold;   // Nilai ambang untuk split
    public $trueBranch;  // Cabang true
    public $falseBranch; // Cabang false
    public $value;       // Nilai jika node adalah daun (leaf)

    public function __construct($attribute = null, $threshold = null, $trueBranch = null, $falseBranch = null, $value = null) {
        $this->attribute = $attribute;
        $this->threshold = $threshold;
        $this->trueBranch = $trueBranch;
        $this->falseBranch = $falseBranch;
        $this->value = $value;
    }
}

class DecisionTree {
    // Pohon keputusan
    public $root; // Root dari pohon keputusan

    public function __construct($data) {
        $this->root = $this->buildTree($data); // Bangun pohon keputusan saat objek dibuat
    }

    private function buildTree($data) {
        // Jika data kosong, kembalikan null
        if (count($data) === 0) {
            return null;
        }

        // Inisialisasi variabel untuk mencari split terbaik
        $bestGain = 0;
        $bestAttribute = null;
        $bestThreshold = null;
        $bestSets = [];

        // Loop melalui setiap atribut yang ada
        foreach (['biaya_kebutuhan_tiap_bulan', 'biaya_sekolah_anak', 'pendapatan_keluarga', 'status_tempat_tinggal'] as $attribute) {
            // Ambil nilai unik dari atribut
            $values = array_unique(array_column($data, $attribute));

            // Loop melalui setiap nilai unik
            foreach ($values as $value) {
                // Bagi data berdasarkan atribut dan nilai
                $sets = $this->splitData($data, $attribute, $value);

                // Hitung informasi gain
                $gain = $this->informationGain($data, $sets);

                // Jika gain lebih baik, simpan split terbaik
                if ($gain > $bestGain) {
                    $bestGain = $gain;
                    $bestAttribute = $attribute;
                    $bestThreshold = $value;
                    $bestSets = $sets;
                }
            }
        }

        // Jika ditemukan split terbaik
        if ($bestGain > 0) {
            // Bangun cabang true dan false
            $trueBranch = $this->buildTree($bestSets[0]);
            $falseBranch = $this->buildTree($bestSets[1]);
            // Kembalikan node dengan split terbaik
            return new TreeNode($bestAttribute, $bestThreshold, $trueBranch, $falseBranch);
        } else {
            // Jika tidak ada split yang baik, buat daun (leaf) dengan nilai mayoritas
            return new TreeNode(null, null, null, null, $this->majorityClass($data));
        }
    }

    private function splitData($data, $attribute, $value) {
        // Bagi data ke dalam dua set berdasarkan nilai atribut
        $trueSet = [];
        $falseSet = [];

        foreach ($data as $row) {
            if ($row[$attribute] == $value) {
                $trueSet[] = $row;
            } else {
                $falseSet[] = $row;
            }
        }

        return [$trueSet, $falseSet];
    }

    private function informationGain($data, $sets) {
        // Hitung entropi sebelum split
        $entropyBefore = $this->entropy($data);
        $entropyAfter = 0;

        // Hitung entropi setelah split
        foreach ($sets as $set) {
            $entropyAfter += (count($set) / count($data)) * $this->entropy($set);
        }

        // Kembalikan informasi gain
        return $entropyBefore - $entropyAfter;
    }

    private function entropy($data) {
        // Hitung entropi dari data
        $total = count($data);
        $counts = array_count_values(array_column($data, 'label'));

        $entropy = 0;
        foreach ($counts as $count) {
            $p = $count / $total;
            $entropy -= $p * log($p, 2);
        }

        return $entropy;
    }

    private function majorityClass($data) {
        // Cari kelas mayoritas dalam data
        $counts = array_count_values(array_column($data, 'label'));
        arsort($counts);
        return array_key_first($counts);
    }

    public function classify($row) {
        // Klasifikasikan baris data dengan pohon keputusan
        return $this->classifyNode($this->root, $row);
    }

    private function classifyNode($node, $row) {
        // Klasifikasi rekursif berdasarkan node
        if ($node->value !== null) {
            return $node->value;
        }

        $attribute = $node->attribute;
        $value = $row[$attribute];

        if ($value == $node->threshold) {
            return $this->classifyNode($node->trueBranch, $row);
        } else {
            return $this->classifyNode($node->falseBranch, $row);
        }
    }
}
