<?php

namespace App\Http\Controllers\Inventario;

use App\Http\Controllers\Controller;
use App\inventoryCategory;
use App\inventoryHistory;
use App\inventoryProduct;
use App\Student;
use Illuminate\Http\Request;
use Symfony\Component\Console\Helper\Helper;

class InventarioController extends Controller
{
    public function index()
    {
        $students= Student::all();
        $categories= inventoryCategory::all();
        $products= inventoryProduct::join('inventory_category','inventory_category.id','inventory_products.category_id')
        ->select('inventory_products.id','inventory_products.code','inventory_products.img','inventory_products.name as product','inventory_products.model',
        'inventory_products.state','inventory_products.stock','inventory_category.name as category')
       ->get();
      // dd($products);
        return view('inventory.index', compact('products','categories'));
    }
    public function add_product()
    {
        $categories= inventoryCategory::all();
        return view('inventory.create', compact('categories'));
    }
    public function edit_product($idProduct)
    {
        $product= inventoryProduct::join('inventory_category','inventory_category.id','inventory_products.category_id')
        ->select('inventory_products.id','inventory_products.code','inventory_products.img','inventory_products.name as product','inventory_products.model',
        'inventory_products.state','inventory_products.stock','inventory_category.name as category','inventory_products.category_id')
        ->where('inventory_products.id',$idProduct)
       ->get();
       $categories= inventoryCategory::all();
       //dd($product[0]->product);
       return view('inventory.edit', compact('product','categories'));
    }
    public function category()
    {
        $categories= inventoryCategory::all();
       return view('inventory.category', compact('categories'));
    }
    public function add_product_store(Request $request)
    {
        inventoryProduct::create([
            'code' => $request->code,
            'img' => $request->imagen,
            'model' => $request->model,
            'name' => $request->productName,
            'category_id' => $request->category,
            'state' => $request->state,
            'stock' => $request->stock,
        ]);
        //return back()->with('delete','Producto Agregado');
        return redirect()->route('inventario.index')->with('edit','Producto Agregado');
    }
    public function edit_product_save(Request $request, $idProducto)
    {

        inventoryProduct::where('id',$idProducto)->update([
            'code' => $request->code,
            'img' => $request->imagen,
            'model' => $request->model,
            'name' => $request->productName,
            'category_id' => $request->category,
            'state' => $request->state,
            'stock' => $request->stock,
        ]);
        //return back()->with('delete','Producto Agregado');
        return redirect()->route('inventario.index')->with('edit','Producto Editado');
    }
    public function product_delete($idProduct)
    {
     inventoryProduct::where('id',$idProduct)->delete();
     return back();
    }
    public function category_store(Request $request)
    {
       inventoryCategory::create([
        'name' => $request->name,
        'description' => $request->description,
       ]);
       return back();
    }
    public function category_update(Request $request,$id)
    {
       inventoryCategory::where('id',$id)
       ->update([
        'name' => $request->name,
        'description' => $request->description,
       ]);
       return back();
    }
    public function categoty_delete_item($idCat)
    {
        inventoryCategory::where('id',$idCat)->delete();
        return back();
    }
    public function stock()
    {
        $code=$this->generateRandomString(10);
        $products=inventoryProduct::all();

        return view('inventory.stock', compact('products','code'));
    }
    public function product_history()
    {
        $history = inventoryHistory::join('inventory_products','inventory_products.id','inventory_history.product_id')
        ->select('inventory_history.id','inventory_history.code','inventory_history.reason','inventory_history.lastStock','inventory_history.actualStock',
    'inventory_products.code as codigoProducto','inventory_products.name','inventory_history.created_at','inventory_history.responsable')->orderBy('inventory_history.created_at','desc')->get();
        return view('inventory.history', compact('history'));
    }

    public  function generateRandomString($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function product_history_save(Request $request)
    {
      //  dd($request->all());
       $product= inventoryProduct::find($request->product);
       $stock= $product->stock - $request->quantity;
       if ($stock < 0) {
          return back()->with('delete','agregado');
       } else {
        inventoryHistory::create([

            'code' => $request->code,
            'reason' => $request->reason,
            'lastStock' => $product->stock,
            'actualStock' => $stock,
            'responsable' => $request->responsable,
            'product_id' => $request->product,
           ]);
           inventoryProduct::where('id',$product->id)->update([
            'stock' => $stock,
           ]);
           return redirect()->route('product_history')->with('delete','agregado');
       }


    }
    public function inventory_report()
    {
        $products= inventoryProduct::all();
        $categories= inventoryCategory::all();
        return view('inventory.reports', compact('products','categories'));
    }
    public function report_history(Request $request)
    {
       // dd($request->all());

        $history= inventoryHistory::join('inventory_products','inventory_products.id','inventory_history.product_id')
        ->select('inventory_history.id','inventory_history.code','inventory_history.reason','inventory_history.lastStock','inventory_history.actualStock',
    'inventory_products.code as codigoProducto','inventory_products.name','inventory_history.created_at','inventory_history.responsable')
    ->where('inventory_products.id',$request->product)
     ->where('inventory_history.created_at','>',$request->starDate)
    ->where('inventory_history.created_at','<',$request->endDate)
    ->orderBy('inventory_history.created_at','desc')->get();
    //dd($history);
        $pdf = \PDF::loadView('inventory.reports.historial', compact('history') );
        // return $pdf->stream();
         return $pdf->download('historial-producto.pdf');
    }
    public function report_state(Request $request)
    {
       // dd($request->all());

       $products= inventoryProduct::join('inventory_category','inventory_category.id','inventory_products.category_id')
       ->select('inventory_products.id','inventory_products.code','inventory_products.img','inventory_products.name as product','inventory_products.model',
       'inventory_products.state','inventory_products.stock','inventory_category.name as category')
       ->where('state',$request->state)
      ->get();
        $pdf = \PDF::loadView('inventory.reports.estado', compact('products') );
        // return $pdf->stream();
         return $pdf->download('estado-producto.pdf');
    }
    public function report_category(Request $request)
    {
       // dd($request->all());

       $products= inventoryProduct::join('inventory_category','inventory_category.id','inventory_products.category_id')
       ->select('inventory_products.id','inventory_products.code','inventory_products.img','inventory_products.name as product','inventory_products.model',
       'inventory_products.state','inventory_products.stock','inventory_category.name as category')
       ->where('inventory_category.id',$request->category)
      ->get();
    //dd($history);
        $pdf = \PDF::loadView('inventory.reports.categoria', compact('products') );
        // return $pdf->stream();
         return $pdf->download('categoria-producto.pdf');
    }


}
