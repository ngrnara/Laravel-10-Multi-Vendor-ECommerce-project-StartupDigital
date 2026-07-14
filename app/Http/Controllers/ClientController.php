<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Client;
use App\Models\Order;

class ClientController extends Controller
{
    public function showLoginForm()
    {
        return view('front.pages.auth.login', [
            'pageTitle' => 'Sign In'
        ]);
    }

    public function showRegisterForm()
    {
        return view('front.pages.auth.register', [
            'pageTitle' => 'Register'
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'password' => 'required|min:6|confirmed',
        ]);

        Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'Active',
        ]);

        return redirect()->route('client.login')
            ->with('success', 'Akun berhasil dibuat, silakan login.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('client')->attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('home-page');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('client')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home-page');
    }

    public function orders()
        {
            // Ambil ID client yang sedang login
            $clientId = Auth::guard('client')->id();

            // 2. Query data orders berdasarkan statusnya masing-masing
            $pendingOrders   = Order::with('items')->where('client_id', $clientId)->where('status', 'Pending')->orderBy('created_at', 'desc')->get();
            $ongoingOrders   = Order::with('items')->where('client_id', $clientId)->whereIn('status', ['Processing', 'Shipped'])->orderBy('created_at', 'desc')->get();
            $completedOrders = Order::with('items')->where('client_id', $clientId)->where('status', 'Completed')->orderBy('created_at', 'desc')->get();
            $cancelledOrders = Order::with('items')->where('client_id', $clientId)->where('status', 'Cancelled')->orderBy('created_at', 'desc')->get();

            // 3. Lempar data ke view front.pages.client.orders
            return view('front.pages.client.orders', [
                'pageTitle' => 'Riwayat Transaksi',
                'pendingOrders' => $pendingOrders,
                'ongoingOrders' => $ongoingOrders,
                'completedOrders' => $completedOrders,
                'cancelledOrders' => $cancelledOrders,
            ]);
        }

}
