<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Subject;
use Tests\TestCase;

class SubjectCreateTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateSubject()
    {
        $newSubject = Subject::create([
             'name'   =>"nueva materia",
             'active' => true
        ]);
    }
}
