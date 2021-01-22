<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col mt-3">
            <h1>Contact Us</h1>
            <div class="card mb-3" style="max-width: 1080px;">
                <div class="row g-0">
                    <div class="col-md-2">
                        <img src="/img/Cready.jpg" class="contact" alt="...">
                    </div>
                    <?php foreach ($alamat as $a) :  ?>
                        <div class="col-md-3">
                            <div class="card-body">
                                <table>
                                    <tr>
                                        <td>
                                            <h6 class="card-text"><?= $a['tipe']; ?></h6>
                                            <h6 class="card-text"><?= $a['alamat']; ?></h6>
                                            <h6 class="card-text"><?= $a['kota']; ?></h6>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>