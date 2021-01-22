<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-3">Detail Perguruan Tinggi</h2>
            <div class="card mb-3" style="max-width: 1080px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/img/<?= $perguruantinggi['gambar']; ?>" class="card-img" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title mb-4"><b><?= $perguruantinggi['nama']; ?></b></h5>
                            <p class="card-text">Alamat : <?= $perguruantinggi['alamat']; ?></p>
                            <p class="card-text">Rektor : <?= $perguruantinggi['rektor']; ?></p>

                            <a href="/perguruantinggi/edit/<?= $perguruantinggi['slug']; ?>" class="btn btn-warning">Edit</a>

                            <form action="/perguruantinggi/<?= $perguruantinggi['id']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin?');">Delete</button>
                            </form>

                            <br><br>
                            <a href="/perguruantinggi">Kembali ke Daftar Perguruan Tinggi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>