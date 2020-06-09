@extends('layouts.master')
@section('content')
<div class="main-content-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>
                                         <label class="main"><input type="checkbox"><span class="main-checkbox"></span> </label>
                                    </th>
                                    <th></th>
                                    <th><p>EMPLOYEE</p></th>
                                    <th><p>SALARY</p></th>
                                    <th><p>STATUS</p></th>
                                    <th><p>MANAGE</p></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                        <td>
                                                 <label class="main"><input type="checkbox"><span class="main-checkbox"></span> </label>
                                        </td>
                                        <td>
                                            <div class="main-content-image">
                                                    <img src="/images/icon.png" alt="logo">
                                            </div>
                                        </td>
                                        <td>
                                            <p> Godwin Daniel </p>
                                            <span>Electrical Engineer</span>
                                        </td>
                                        <td>
                                            <p> 4,500 Naira </p>
                                            <span>Full Time</span>
                                        </td>
                                        <td>
                                            <p>test period</p>
                                            <span>2 Months</span>
                                        </td>
                                        <td>
                                        <p><span>E</span>|<span></span>D</p>
                                        
                                        </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

@endsection