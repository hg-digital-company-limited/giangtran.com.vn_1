<?php

namespace App\Livewire\Page;

use App\Repositories\SmmOrder\SmmOrderRepositoryInterface;
use App\Repositories\SourceCodeOrder\SourceCodeOrderRepositoryInterface;
use Auth;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class Home extends Component
{

    use LivewireAlert;
    protected $smmOrderRepository;
    protected $sourceCodeRepository;
    public $countSmmOrder;
    public $countSourceCodeOrder;
    public function mount(SmmOrderRepositoryInterface $smmOrderRepository, SourceCodeOrderRepositoryInterface $sourceCodeRepository)
    {
        $this->smmOrderRepository = $smmOrderRepository;
        $this->sourceCodeRepository = $sourceCodeRepository;
        $this->countSmmOrder = $this->smmOrderRepository->getOrdersByCurrentUser()->count();
        $this->countSourceCodeOrder = $this->sourceCodeRepository->getAllByUser(Auth::user()->id)->count();
        // $this->dispatch('showModalLogout');
    }
    public function showModalLogout()
    {
        $this->dispatch('showModalLogout');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    public function render()
    {
        return view('livewire.page.home');
    }
}
