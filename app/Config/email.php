<?php is_null(env('CAKE_ENV')) ? config('Email/development') : config('Email/' . env('CAKE_ENV'));
