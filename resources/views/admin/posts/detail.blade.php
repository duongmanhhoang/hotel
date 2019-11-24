@extends('admin.layouts.master')
@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-xl-12">
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                @if($data->parentTranslate != null)
                                    <a href="{{ route('admin.post.detailPost', $data->parentTranslate->id) }}">
                                        <img
                                                src="{{ asset(config('common.uploads.languages') . '/' . $data->parentTranslate->language->short) }}"
                                                alt="{{ $data->parentTranslate->language->short }}">
                                    </a>

                                @else

                                    @foreach($data->childrenTranslate as $value)
                                        <a href="{{ route('admin.post.detailPost', $value->id) }}">
                                            <img
                                                    src="{{ asset(config('common.uploads.languages') . '/' . $value->language->short) }}"
                                                    alt="{{ $value->language->short }}">
                                        </a>
                                    @endforeach

                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">

                        <b style="font-size: 18px">
                            {{ $data->title }}
                            <span style="font-size: 14px; color: lightgrey; margin-left: 24px">Date: {{ $data->updated_at }}</span>
                            <span style="font-size: 14px; color: lightgrey; margin-left: 24px">Author: {{ $data->postedBy->full_name }}</span>
                        </b>

                        <br>

                        <img src="{{ asset(config('common.uploads.posts')) . '/' . $data->image }}"
                             style="width: 225px; height: 250px; object-fit: cover; margin: 24px 0;"
                             alt=""
                        >

                        <hr>
                        <p style="font-size: 18px">{{ $data->description }}</p>

                        {!!  $data->body  !!}

                        <div style="clear: both"></div>

                        <div class="row" style="margin-top: 32px">
                            <div class="col-10">
                                <a href="{{ url()->previous() }}" class="btn btn-danger">Quay lại</a>
                            </div>


                            <div class="col-2">
                                @if($data->approve == config('common.posts.approve_key.pending'))
                                    @if($user->role_id == config('common.roles.super_admin'))
                                        <a href="{{ route('admin.post.approvingPost', ['id' => $data->id, 'approve' => config('common.posts.approve_key.approved')]) }}"
                                           class="btn btn-success"
                                           title="Duyệt">
                                            <i class="la la-check"> Duyệt</i>
                                        </a>

                                        <a href="javascript:;"
                                           data-target="#modalAdvance"
                                           data-toggle="modal"
                                           onclick="setFormActionUrl({{ $data->id }})"
                                           class="btn btn-danger"
                                           title="Từ chối">
                                            <i class="la la-close"> Từ chối</i>
                                        </a>
                                    @endif

                                @else
                                    @if($data->approve == config('common.posts.approve_key.approved'))
                                        <p class="text-success" style="float: right; font-size: 20px">Bài viết đã được chấp thuận</p>
                                    @else
                                        <p class="text-danger" style="float: right; font-size: 20px">Bài viết đã bị từ chối</p>
                                    @endif

                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="modal fade show" id="modalAdvance" tabindex="-1"
                         role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Từ chối
                                        bài viết</h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="reject-post">
                                        @csrf

                                        <div class="form-group m-form__group">
                                            <label>Lí do từ chối <b
                                                        class="text-danger">*</b></label>
                                            <textarea name="message_reject"
                                                      class="form-control"
                                                      style="min-height: 140px"></textarea>
                                            @if ($errors->has('message_reject'))
                                                <b class="text-danger">{{ $errors->first('message_reject') }}</b>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Hủy
                                    </button>
                                    <button type="button"
                                            class="btn btn-danger submit-reject-post">
                                        Từ chối
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>

        $('.submit-reject-post').on('click', function () {
            $('#reject-post').submit();
        });


        function setFormActionUrl(id) {
            let rejectRoute = `{{ route('admin.post.approvingPost', ['', '']) }}/${id}/{{ config('common.posts.approve_key.rejected') }}`;

            let form = $('#reject-post');

            form.attr('action', rejectRoute);
        }
    </script>

@endsection
