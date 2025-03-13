<?php

class Animal {
    public $animals;

    public function __construct($ar_animal) {
        $this->animals = $ar_animal;
    }

    public function index() {
        foreach ($this->animals as $animal) {
            echo "- $animal <br/>";
        }
    }

    public function store($animal) {
        $this->animals[] = $animal;
    }

    public function update($index, $animal) {
        $this->animals[$index] = $animal;
    }

    public function destroy($index) {
        unset($this->animals[$index]);
    }
}

$animal = new Animal(["ayam", "ikan"]);

echo "index - Menampilkan seluruh hewan <br/>";
$animal->index();
echo "<br/>";

echo "store - Menambahkan hewan baru (burung) <br/>";
$animal->store("burung");
$animal->index();
echo "<br/>";

echo "Update - Mengupdate hewan <br/>";
$animal->update(0, "kucing persia");
$animal->index();
echo "<br/>";

echo "Destroy - Menghapus hewan <br/>";
$animal->destroy(1);
$animal->index();
echo "<br/>";