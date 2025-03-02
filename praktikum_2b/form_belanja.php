<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Belanja</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <form method="POST" action="total_belanja.php" class="container mt-5">
        <fieldset class="border border-dark p-3 rounded" style="background-color: lightgray;">
            <legend class="float-none w-auto px-3 fw-bold h3">Belanja Online</legend>
            <div class="container mt-5">

                <div class="form-group row">
                    <label for="customer" class="col-4 col-form-label">Nama Customer</label>
                    <div class="col-8">
                        <input id="customer" name="customer" placeholder="*Nama Customer" type="text" required="required" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-4 col-form-label">Pilih Produk</label>
                    <div class="col-8">
                        <div class="form-group row">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input name="produk" id="produk1" type="radio" class="custom-control-input" value="Laptop" required="required">
                                <label for="produk1" class="custom-control-label">Laptop</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input name="produk" id="produk2" type="radio" class="custom-control-input" value="Smartphone" required="required">
                                <label for="produk2" class="custom-control-label">Smartphone</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input name="produk" id="produk3" type="radio" class="custom-control-input" value="Tablet" required="required">
                                <label for="produk3" class="custom-control-label">Tablet</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="jumlah" class="col-4 col-form-label">Jumlah</label>
                    <div class="col-8">
                        <input id="jumlah" name="jumlah" type="number" min="1" class="form-control" required="required">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="offset-4 col-8">
                        <button name="proses" type="submit" class="btn btn-primary">Hitung Total</button>
                    </div>
                </div>

            </div>
        </fieldset>
    </form>
</body>

</html>
