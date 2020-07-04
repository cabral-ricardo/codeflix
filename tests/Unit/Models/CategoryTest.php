<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
//use Illuminate\Foundation\Testing\DatabaseMigrations;
//use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryTest extends TestCase
{
    //use DatabaseMigrations;
    private $category;

    public static function setUpBeforeClass(): void {
        parent::setUpBeforeClass();
    }

    protected function setUp(): void {
        parent::setUp();
        $this->category = new Category();
    }

    protected function tearDown(): void {
        parent::tearDown();
    }

    public static function tearDownAfterClass(): void {
        parent::tearDownAfterClass();
    }

    public function testFillableAttribute()
    {
        $fillable = ['name', 'description', 'is_active'];
        $this->assertEquals($fillable, $this->category->getFillable());
    }

    public function testIfUseTraitsAttribute()
    {
        //Genre::create(['name' => 'test']);
        $traits = [
            SoftDeletes::class, 
            Uuid::class
        ];
        //print_r(class_uses(Category::class));
        $categoryTraits = array_keys(class_uses(Category::class));
        $this->assertEquals($traits, $categoryTraits);
    }

    public function testCastAttribute()
    {
        $casts = ['id' => 'string', 'is_active' => 'boolean'];
        $this->assertEquals($casts, $this->category->getCasts());
    }

    public function testIncrementingAttribute()
    {
        $this->assertFalse($this->category->incrementing);
    }

    public function testDatesAttribute()
    {
        $dates = ['deleted_at', 'created_at', 'updated_at'];
        //dd($dates, $this->category->getDates());
        foreach ($dates as $date){
            $this->assertContains($date, $this->category->getDates());
        }
        $this->assertCount(count($dates), $this->category->getDates());
    }
}
