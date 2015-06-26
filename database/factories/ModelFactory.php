<?php

use Carbon\Carbon;

$factory->define(Keep\Entities\User::class, function ($faker) {
    return [
        'name'     => $faker->name,
        'email'    => $faker->email,
        'password' => 'secret',
        'active'   => true
    ];
});

$factory->define(Keep\Entities\Profile::class, function ($faker) {
    return [
        'location'          => $faker->address,
        'bio'               => $faker->paragraph(3),
        'company'           => $faker->company,
        'website'           => $faker->url,
        'phone'             => $faker->phoneNumber,
        'twitter_username'  => $faker->userName,
        'github_username'   => $faker->userName,
        'facebook_username' => $faker->userName,
        'google_username'   => $faker->userName
    ];
});

$factory->define(Keep\Entities\Task::class, function ($faker) {
    $timestamp = Carbon::now()
        ->subDays(rand(0, 15))
        ->subHours(rand(1, 20));

    return [
        'priority_id'    => rand(1, 4),
        'title'          => ucfirst(implode(' ', $faker->words(5))),
        'content'        => implode(' ', $faker->paragraphs(1)),
        'location'       => $faker->address,
        'is_assigned'    => false,
        'starting_date'  => $timestamp,
        'finishing_date' => $timestamp->addDays(rand(0, 15))->addHours(rand(1, 20)),
        'created_at'     => $timestamp,
        'updated_at'     => $timestamp
    ];
});

$factory->define(Keep\Entities\Tag::class, function ($faker) {
    return [
        'name' => implode(' ', $faker->words(2))
    ];
});

$factory->define(Keep\Entities\Group::class, function ($faker) {
    return [
        'name'        => ucfirst(implode(' ', $faker->words(5))),
        'description' => $faker->paragraph(4)
    ];
});

$factory->define(Keep\Entities\Assignment::class, function ($faker) {
    return [
        'assignment_name' => ucfirst(implode(' ', $faker->words(6)))
    ];
});

$factory->define(Keep\Entities\Notification::class, function ($faker) {
    $types = ['default', 'info', 'success', 'warning', 'danger'];

    return [
        'sent_from' => 'admin',
        'type'      => array_random_val($types),
        'subject'   => $faker->sentence(),
        'body'      => $faker->paragraph(),
        'sent_at'   => Carbon::now()
    ];
});
