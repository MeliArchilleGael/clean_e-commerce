<div class="container" style="margin-left: 170px;">


    <div class="row">
        <h1 class="text-center m-1">Liste Des Produits Disponible</h3>
            <?php if (!empty($produits)) {
                foreach ($produits as $key => $produit) {
            ?>
                    <div class=" card col-md-3 col-lg-3 m-2">
                        <div class="card-header">
                            <div style="justify-content: space-between; display: flex;">
                                <span><?= $produit['LABELS'] ?> </span>
                                <span><?= number_format($produit['PRIX']) ?> £ </span>
                            </div>
                        </div>
                        <div class="row card-body">
                            <div class="col-lg-3 col-md-3">
                                <img height="150px" src="<?= URL . '/public/images/produits/' . $produit['IMAGE_PROD'] ?>" alt="">
                            </div>
                        </div>
                        <div class="card-footer">
                            <form action="<?= URL.'/chariot/AJouterAuChariot' ?>" method="POST">
                                <div style="justify-content: space-between; display: flex;">
                                    <span>
                                        <input type="number" name="quantite" min="1" max="<?= $produit['QUANTITE'] ?>">
                                    </span>
                                    <span>
                                        <input type="hidden" name="produit" value="<?= $produit['REF_PROD'] ?>">
                                    </span>
                                    <span><button class="btn btn-info" href="">AJouter au panier </button></span>
                                </div>
                            </form>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
    </div>
</div>