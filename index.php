<!DOCTYPE html>
<html>
<head>
    <title>Pencarian Makanan</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Pencarian Makanan</h1>
        <form method="GET" action="index.php">
            <label for="nama-makanan">Cari Makanan:</label>
            <div class="input-group">
                <input type="text" name="nama-makanan" id="nama-makanan">
                <button type="submit">Cari</button>
            </div>
        </form>
        <?php
if (isset($_GET['nama-makanan'])) {
    $nama_makanan = urlencode($_GET['nama-makanan']);
    $url = 'https://www.themealdb.com/api/json/v1/1/search.php?s=' . $nama_makanan;
    $json = file_get_contents($url);
    $data = json_decode($json);

    if ($data->meals) {
        $meals = $data->meals;
    } else {
        $meals = false;
    }
}
?>
    </div>
    <div class="container">
        <h1>Hasil Pencarian Makanan</h1>
        <?php if (isset($meals)) : ?>
            <?php if ($meals) : ?>
                <div class="meals">
                    <?php foreach ($meals as $meal) : ?>
                        <div class="meal">
                            <h2><?php echo $meal->strMeal; ?></h2>
                            <img src="<?php echo $meal->strMealThumb; ?>">
                            <p><?php echo $meal->strInstructions; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <p class="no-results">Makanan yang Anda cari tidak ditemukan.</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>
