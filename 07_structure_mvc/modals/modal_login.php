<div class="modal fade" id="user-login">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row justify-content-center text-center">
                        <form action="./controllers/controller_login.php" method="POST" class="col-sm-6">
                            <?php if(!empty($err_login)) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <p><?= $err_login ?></p>
                                </div>
                            <?php endif; ?>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address :</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password :</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        <p> Pas de compte ? <a href="?page=register">Inscrivez-vous !</a></p>
                        <?php
                        if (!empty($errors)): ?>
                            <div class="alert alert-danger" role="alert">
                            <p> L'email ou le mot de passe est incorrect, DECHET ! </p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
