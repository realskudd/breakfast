<div class="jumbotron">
    <h2>Login!</h2>
    <p>
        You probably noticed the domain name here is not <code>*.softlayer.com</code> or <code>*.softlayer.local</code>.
        Your concern is noted, but let me assure you, this is not a thing running on the public internet. It's restricted
        to the SoftLayer internal private network. If you have any questions about the security of this site, contact
        <a href="mailto:tgarrison@softlayer.com">Tim Garrison</a>.
    </p>
</div>

<form method="post" action="<?=$this->url('Auth', 'login')?>">
    <dl class="dl-horizontal">
        <dt>Username:</dt>
        <dd>
            <input type="text" name="username" class="col-lg-5 form-control" />
        </dd>

        <dt>Password:</dt>
        <dd>
            <input type="password" name="password" class="col-lg-5 form-control" />
        </dd>

        <dt>VIP Auth Token:</dt>
        <dd>
            <input type="text" name="auth-token" class="col-lg-3 form-control" />
        </dd>

        <dt>&nbsp;</dt>
        <dd>
            <input type="submit" value="Login" class="btn btn-default" autocomplete="false" />
        </dd>
    </dl>
</form>