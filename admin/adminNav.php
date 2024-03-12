<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="quiz_code.php">Quiz App</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto nav-pills">
            <li class="nav-item <?php if ($currentPage == 'quiz_code') {
                                    echo 'active';
                                } ?>">
                <a class="nav-link" href="quiz_code.php">Quizes</a>
            </li>
            <li class="nav-item <?php if ($currentPage == 'users') {
                                    echo 'active';
                                } ?>">
                <a class="nav-link" href="users.php">Users</a>
            </li>
            <li class="nav-item <?php if ($currentPage == 'score') {
                                    echo 'active';
                                } ?>">
                <a class="nav-link" href="score.php">Score</a>
            </li>
            <?php if ($currentPage == 'question') {
                echo '<li class="nav-item active">
                             <a class="nav-link" disabled>Questions</a>
                    </li>';
            } ?>
        </ul>
        <div class="navbar-text">
            <a href="php/adminLogout.php">Logout</a>
        </div>
    </div>
</nav>