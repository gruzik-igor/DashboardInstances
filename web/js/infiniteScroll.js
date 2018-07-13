let is_loading = false;

$(function () {
    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() == $(document).height()) {
            if (is_loading == false) {
                is_loading = true;
                var infiniteScrollBody = $('#infiniteScrollBody');

                var currentLimit = infiniteScrollBody.attr('data-current-offset');

                //ajaxSpinnerShow($('#loader'));

                var url = infiniteScrollBody.attr('data-url');
                var method = infiniteScrollBody.attr('data-method');
                $.ajax({
                    url: url + '?_offset=' + (parseInt(currentLimit) + 1) + '&_limit=1',
                    type: method,
                    success: function (data, status, reqeust) {
                        infiniteScrollBody.attr('data-current-offset', (parseInt(currentLimit) + 1));
                        var html = '';
                        $(data).each(function (index, item) {
                            var resourcesHtml = '';

                            $(item.resources).each(function (index, resource) {
                                if (resource.value) {
                                    if (resource.resource.name == 'RAM') {
                                        resourcesHtml += resource.resource.name + ': ' + resource.value + ' MB' + '<br>';
                                    }
                                    if (resource.resource.name == 'HDD') {
                                        resourcesHtml += resource.resource.name + ': ' + resource.value + ' GB' + '<br>';
                                    }
                                    if (resource.resource.name == 'CPU') {
                                        resourcesHtml += resource.resource.name + ': ' + resource.value + ' %' + '<br>';
                                    }
                                } else {
                                    if (resource.resource.name == 'RAM') {
                                        resourcesHtml += resource.resource.name + ': ' + resource.defaultValue + ' MB' + '<br>';
                                    }
                                    if (resource.resource.name == 'HDD') {
                                        resourcesHtml += resource.resource.name + ': ' + resource.defaultValue + ' GB' + '<br>';
                                    }
                                    if (resource.resource.name == 'CPU') {
                                        resourcesHtml += resource.resource.name + ': ' + resource.defaultValue + ' %' + '<br>';
                                    }
                                }
                            });

                            var licenseHtml = '';

                            if (item.license != ''){
                                licenseHtml += 'Issued:'+ item.license.issued + '<br>';
                                 licenseHtml += 'Usage:'+ item.usageLicenseCount + '<br>';
                                licenseHtml += 'Rate:'+ item.license.rate + '$/license/month <br>';
                            } else {
                                licenseHtml += '<div class="alert alert-warning" role="alert"> Sorry! This instance has no license!</div>';
                            }

                            var invoiceHtml = '';

                            if(item.invoice){
                                invoiceHtml += + item.invoice.price +'$ @' + item.invoice.creationDate|date("Y-m-d")+'<br>';
                                invoiceHtml +=  'Status:'+ item.invoice.status + '<br>';
                        invoiceHtml += 'Next invoice:'+ item.invoice.expirationDate|date("Y-m-d")+ '<br>';
                            } else {
                                invoiceHtml += '<div class="alert alert-warning" role="alert">Sorry! This instance has no last invoice!</div>';
                            }

                            html +=
                                '<thead>' +
                                '<tr>' +
                                '<th>Instance</th>' +
                                '<th>Contact Person</th>' +
                                '<th>Resources used:</th>' +
                                '<th>Resources limits:</th>' +
                                '<th>Licenses:</th>' +
                                '<th>Latest invoice:</th>' +
                                '<th>Instance status: ' + item.status + '</th>' +
                                '</tr>' +
                                '</thead>' +
                                '<tbody>' +
                                '<tr>' +
                                '<td>' + item.name + '</td>' +
                                '<td>' + item.contactPerson + '</td>' +
                                '<td>Average CPU:25% <br>' + 'Average RAM: 256 Mb <br>' + 'Average HDD: 2345 Mb' +
                                '</td>' +
                                '<td>' +
                                resourcesHtml +
                                '</td>' +
                                '<td>' +
                                licenseHtml +
                                '</td>' +
                                '<td>' +
                                invoiceHtml +
                                '</td>' +
                                '<td>' +
                                '<a class="btn btn-primary btn-block" href="/instance-resources/' + item.id +'">Resources</a>' +
                                '<a class="btn btn-danger btn-block" href="/instance/' + item.id + '?status=suspended">Suspend</a>' +
                                '<a class="btn btn-success btn-block" href="/instance/' + item.id + '?status=activated">Activate</a>' +
                                '</td>' +
                                '</tr>' +
                                '</tbody>'
                        });

                        infiniteScrollBody.append(html);

                        is_loading = false;
                    }
                });
            }
        }
    });
});