<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Member;

class MemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Member::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // ใช้ bcrypt เพื่อแฮชรหัสผ่าน
            'phone' => $this->faker->phoneNumber,
            'user_type' => $this->faker->randomElement(['admin', 'editor', 'viewer']),
        ];
    }
}
