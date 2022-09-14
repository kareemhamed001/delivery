<div>
    <section class="container-fluid d-flex flex-column my-2 py-3 position-relative">



        <div class="text-start">
            <div class="d-flex flex-column ">
                <div class="col-12">
                    <h3 class="font-roboto font-size-3-rem col-12 text-center">بليبل</h3>
                </div>

                <div class="col-6">
                    <input type="text" class="form-control" placeholder="search" wire:model="term">
                </div>
            </div>


            <div class="card">
                <div class="card-body table-responsive-sm  ">

                    @include('livewire.driver.inc.ordersTable')

            </div>

        </div>
    </section>
</div>
