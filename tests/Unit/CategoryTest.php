<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function testFillableAttribute()
    {
        $fillable = ['name', 'description', 'is_active'];
        $category = new Category();
        $this->assertEquals($fillable, $category->getFillable());
    }

    public function testIfUseTraitsAttribute()
    {
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
        $casts = ['id' => 'string'];
        $category = new Category();
        $this->assertEquals($casts, $category->getCasts());
    }

    public function testIncrementingAttribute()
    {
        $category = new Category();
        $this->assertFalse($category->incrementing);
    }

    public function testDatesAttribute()
    {
        $dates = ['deleted_at', 'created_at', 'updated_at'];
        $category = new Category();
        //dd($dates, $category->getDates());
        foreach ($dates as $date){
            $this->assertContains($date, $category->getDates());
        }
        $this->assertCount(count($dates), $category->getDates());
    }
}
