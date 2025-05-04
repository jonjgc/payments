use App\Http\Controllers\Api\TransferController;

Route::post('/transfer', [TranferController::class, 'store']);
