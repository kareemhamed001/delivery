<div>
    <section class="container-fluid d-flex flex-column my-2 py-3 overflow-hidden position-relative">
        <div class="my-2">
            <div class="d-flex flex-column ">
                <div class="col-12">
                    <h3 class="font-roboto font-size-3-rem col-12 text-center  ">Today's orders</h3>
                </div>

                <div class="col-12 col-md-4">
                    <input type="text" class="form-control" placeholder="search"  wire:model="term">
                </div>
            </div>
        </div>

        <div class="">
            @include('livewire.driver.inc.ordersTable')
        </div>
    </section>
</div>
@push('scripts')
    <script>
        window.addEventListener('close-modals', function () {
            $('#showOrderModal').modal('hide');
            $('#acceptOrderModal').modal('hide');
        });

        window.addEventListener('openShowOrderModal', function () {
            $('#showOrderModal').modal('show');

        });
        window.addEventListener('openAcceptOrderModal', function () {

            $('#acceptOrderModal').modal('show');
        });
    </script>
@endpush
