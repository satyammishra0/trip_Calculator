<header>
    <div>
        <h1 class="header-brand-name">
            <a href="<?= url(); ?>"><?= APP_NAME ?></a>
        </h1>
    </div>
    <nav>
        <ul class="header-menu-list">
            <li><a href="<?= url("group/create") ?>">Create group</a></li>
            <li><a href="#">Join Group</a></li>
            <li>
                <div class="user-profile-icon">
                    <p>
                        <?= substr(_name(), 0, 1) ?>
                    </p>
                </div>
            </li>
        </ul>
    </nav>
</header>