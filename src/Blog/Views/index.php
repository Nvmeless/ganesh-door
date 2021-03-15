<?= $renderer->render('header');
?>
<h1> Bienvenue sur le blog</h1>
<div id="cards"></div>
<div class="spacer-container">
    <h3 class="text-dark neo-p-m-spe">Card 1</h3>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card bg-primary border-light shadow-soft">
                <img src="http://www.neostrap.net/asstets/img/company_layout/company_layout_3_s.png" class="card-img-top rounded-top" alt="Themesberg office">
                <div class="card-body">
                    <span class="h6 icon-tertiary small"><span class="fas fa-medal mr-2"></span>Awards</span>
                    <h3 class="h5 card-title mt-6">We partnered up with Google</h3>
                    <p class="card-text mb-6">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="<?= $router->generateUri('blog.show', ['slug' => 'mon-article']); ?>" class="btn btn-primary btn-sm">Learn More</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card bg-primary border-light shadow-soft">
                <div class="card-header p-6 pb-1">
                    <img src="asstets/img/company_layout/company_layout_2_s.png" class="card-img-top rounded" alt="Designer desk">
                </div>
                <div class="card-body pt-2">
                    <div class="media d-flex align-items-center justify-content-between">
                        <div class="post-group">
                            <img class="avatar-sm mr-2 img-fluid rounded-circle" src="http://www.neostrap.net/asstets/img/team/woman_profile_1_s.png" alt="Jo portrait">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="23k followers">Jo J. Moore
                            </a>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="small"><span class="far fa-calendar-alt mr-2"></span>15 March 2020</span>
                        </div>
                    </div>
                    <h3 class="h5 card-title mt-6">We partnered up with Google</h3>
                    <p class="card-text mb-6">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary btn-sm">Learn More</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card bg-primary border-light shadow-soft">
                <img src="http://www.neostrap.net/asstets/img/company_layout/company_layout_3_s.png" class="card-img-top rounded-top" alt="Themesberg office">
                <div class="card-body">
                    <span class="h6 icon-tertiary small"><span class="fas fa-medal mr-2"></span>Awards</span>
                    <h3 class="h5 card-title mt-6">We partnered up with Google</h3>
                    <p class="card-text mb-6">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary btn-sm">Learn More</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card bg-primary border-light shadow-soft">
                <div class="card-header p-6 pb-1">
                    <img src="asstets/img/company_layout/company_layout_2_s.png" class="card-img-top rounded" alt="Designer desk">
                </div>
                <div class="card-body pt-2">
                    <div class="media d-flex align-items-center justify-content-between">
                        <div class="post-group">
                            <img class="avatar-sm mr-2 img-fluid rounded-circle" src="http://www.neostrap.net/asstets/img/team/woman_profile_1_s.png" alt="Jo portrait">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="23k followers">Jo J. Moore
                            </a>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="small"><span class="far fa-calendar-alt mr-2"></span>15 March 2020</span>
                        </div>
                    </div>
                    <h3 class="h5 card-title mt-6">We partnered up with Google</h3>
                    <p class="card-text mb-6">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary btn-sm">Learn More</a>
                </div>
            </div>
        </div>
    </div>

</div>


<?= $renderer->render('footer');
?>