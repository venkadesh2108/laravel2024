<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BillingInformation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <div class="container billing-container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Billing Information</div>
                    <div class="card-body">
                        <form action="{{ route('billing') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="tableno">TableNo</label>
                                <input type="text" id="tableno" name="tableno" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="orders">OrderList</label>
                                <input type="text" id="orders" name="orders" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="totalamount">TotalAmount</label>
                                <input type="text" id="totalamount" name="totalamount" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>

                        </form>

                        <a href="overallbillingdata" class="btn btn-info">AllBillingList</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>





