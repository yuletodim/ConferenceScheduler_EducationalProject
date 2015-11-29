<div class="col-lg-6" ng-controller="LoginController">
    <div class="well bs-component">
        <form class="form-horizontal">
            <legend>Login</legend>

            <div class="form-group">
                <label for="username" class="col-lg-2 control-label">Username</label>
                <div class="col-lg-10">
                    <input name="username" class="form-control" id="username" placeholder="Username" type="text" required />
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="col-lg-2 control-label">Password</label>
                <div class="col-lg-10">
                    <input name="password" class="form-control" id="password" placeholder="Password" type="password" required />
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="col-lg-6" id="main-img">
    <img src="http://localhost/ConferenceScheduler_EducationalProject/content/imgs/conference.jpg" alt="conference pic">
</div>