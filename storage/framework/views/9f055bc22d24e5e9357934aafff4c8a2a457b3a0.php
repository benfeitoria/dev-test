<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
</head>
<body>
    <div id="app" style="display:none">

      <topo titulo="<?php echo e(config('app.name', 'Laravel')); ?>" url="<?php echo e(url('/')); ?>">

        <!-- Authentication Links -->
        <?php if(auth()->guard()->guest()): ?>
            <li><a href="<?php echo e(route('login')); ?>">Login</a></li>
            <li><a href="<?php echo e(route('register')); ?>">Register</a></li>
        <?php else: ?>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('autor')): ?>
                    <li>
                      <a href="<?php echo e(route('admin')); ?>">Admin</a>
                    </li>
                  <?php endif; ?>


                    <li>
                        <a href="<?php echo e(route('logout')); ?>"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo e(csrf_field()); ?>

                        </form>
                    </li>
                </ul>
            </li>
        <?php endif; ?>

      </topo>

        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <!-- Scripts -->
    <script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
</body>
</html>
