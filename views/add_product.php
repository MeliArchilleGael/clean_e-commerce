<section>
    <div class = "container py-5">
    <div class="row">
            <div class="col-md-8 col-sm mx-auto">
                                
                <div class = "card">
                    <div class = "card-header">
                        <h1 class = "b-title fs-2 mb-2">Ajouter un Produit</h1>
                    </div>
                    <div class = "card-body border-top border-orange">
                        <form action = "" method = "" enctype="multipart/form-data">
                            <div class="cc-ff">
                                <label for = "title" class = "form-label">Titre : </label>
                                <div class = "input-group mb-3">
                                    <span class = "input-group-text" id = "title"><i class = "fas fa-heading"></i></span>
                                    <input type="text" class = "form-control" id = "title" placeholder="titre de l'article" name = "title" value = "">
                                <!-- afficher le message d'erreur -->
                                </div>
                            </div>
                            <div class = "cc-ff">
                                <label for = "category">Categorie : </label>
                                <div class = "input-group mb-3">
                                    <label class = "input-group-text" for="category"><i class="fas fa-folder"></i></label>
                                    <select class="form-select" id = "category" name = "category[]" multiple>
                                        <option value = "science">Science</option>
                                        <option value="IA">IA</option>
                                        <option value="Sport">Sport</option>
                                    </select> 
                                    <!-- afficher le message d'erreur -->
                                </div>
                            </div>
                            <div class="cc-ff">
                                <label for="image">Image : </label>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" id = "image" name = "image">
                                    <label class="input-group-text" for="image"><i class="fas fa-image"></i></label>
                                    <!-- message d'erreur php -->
                                </div>
                            </div>
                            <div class="cc-ff">
                                <label for="content">Description : </label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" for="content"><i class="fas fa-info-circle"></i></span>    
                                    <textarea class="form-control" id = "content" name = "content"></textarea>
                                    
                                    <!-- message d'erreur php -->
                                </div>
                            </div>
                            <input type="submit" name="ajouter" value="Ajouter" class="cc-btn">
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

