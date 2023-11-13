<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::get("/register", [AuthController::class, "getRegister"])->name("register");
    Route::post("/register", [AuthController::class, "postRegister"])->name("post.register");

    Route::get("/login", [AuthController::class, "getLogin"])->name("login");
    Route::post("/login", [AuthController::class, "postLogin"])->name("post.login");

    Route::get("/logout", [AuthController::class, "getLogout"])->name("logout");
});


Route::middleware('auth')->group(function () {
    Route::get("/", [TodoController::class, "index"])->name("home");

    Route::prefix('todo')->group(function () {
        Route::post("/add", [TodoController::class, "postAdd"])->name("post.todo.add");
        Route::post("/edit", [TodoController::class, "postEdit"])->name("post.todo.edit");
        Route::post("/delete", [TodoController::class, "postDelete"])->name("post.todo.delete");
    });
});

Route::middleware('auth', 'check.roles:Admin')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::prefix('users')->group(function () {
            Route::get("/", [UserController::class, "getUsersRoleAdmin"])->name("admin.users");
        });
    });
});
