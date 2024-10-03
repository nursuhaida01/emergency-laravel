<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member; // ตรวจสอบให้แน่ใจว่าได้ import โมเดล Member

class MemberSeeder extends Seeder
{
    /**
     * Seed the database with members.
     *
     * @return void
     */
    public function run()
    {
        // สร้างข้อมูลสมาชิกตัวอย่าง
        Member::factory(10)->create(); // สร้าง 10 รายการสมาชิกโดยใช้ MemberFactory
    }
}
