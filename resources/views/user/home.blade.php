@extends('user.layout')


@section('title')
    Home
@endsection

@section('script')

@endsection

@section('page_content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>Thong tin tai khoan</h3>
                <div class="col-lg-8">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th style="text-align: center">So tai khoan</th>
                            <th style="text-align: center">So du tai khoan</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td style="text-align: center">19030607132019</td>
                            <td style="text-align: center">33333333333</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection