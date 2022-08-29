<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('title', 256);
            $table->string('slug', 128);
            $table->text('content');
            $table->text('options')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->foreignIdFor(Category::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};

/*
    [
        'draft' => 0,
        'publish' => 5,
        'approved' => 10,
        'rejected' => 15
    ]

    enum Status : int{
        case DRAFT = 0;
        case PUBLISH = 1;
    }
    Status::DRAFT
    Status->from(0)
*/