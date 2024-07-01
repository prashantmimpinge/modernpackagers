<?php
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class AddColumnsToProductsTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::table('products', function (Blueprint $table) {
                $table->boolean('b_2_b')->default(false);
                $table->decimal('discount', 10, 2)->default(0)->after('b_2_b');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('b_2_b');
                $table->dropColumn('discount');
            });
        }
    }
