<?php
use App\Models\User;
use App\Models\ProductCategory;
use App\Models\ProductInventory;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title', 2000);
            $table->foreignId('category_id')->references('id')->on('product_categories');
            $table->foreignId('inventory_id')->references('id')->on('product_inventories');
            $table->string('image', 2000)->nullable();
            $table->string('image_mime')->nullable();
            $table->integer('image_size')->nullable();
            $table->longtext('description')->nullable();
            $table->decimal('price',10,2);
            $table->foreignIdFor(User::class,'created_by')->nullable();
            $table->foreignIdFor(User::class,'updated_by')->nullable();
            $table->softDeletes();
            $table->foreignIdFor(User::class,'deleted_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
