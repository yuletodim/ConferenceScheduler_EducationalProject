<div class="col-lg-6">
    <div class="well bs-component">
        <form class="form-horizontal" method="post">
            <legend>Register</legend>

            <div class="form-group">
                <label for="username" class="col-lg-2 control-label">Username</label>
                <div class="col-lg-10">
                    <input name="username" class="form-control" id="username" placeholder="Username" type="text" required />
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="col-lg-2 control-label">Email</label>
                <div class="col-lg-10">
                    <input name="email" class="form-control" id="inputEmail" placeholder="Email" type="email" required />
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="col-lg-2 control-label">Password</label>
                <div class="col-lg-10">
                    <input name="password" class="form-control" id="password" placeholder="Password" type="password" required />
                </div>
            </div>

            <div class="form-group">
                <label for="confirm-password" class="col-lg-2 control-label">Confirm password</label>
                <div class="col-lg-10">
                    <input name="confirm-password" class="form-control" id="confirm-password" placeholder="Confirm password" type="password" required />
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button class="btn btn-primary" type="submit">Register</button>
                </div>
            </div>

            <div class="text-warning"><?php echo $this->error;?></div>
        </form>
    </div>
</div>
<div class="col-lg-6" id="main-img">
    <img src="http://localhost/ConferenceScheduler_EducationalProject/content/imgs/conference.jpg" alt="conference pic">
</div>