app.controller('leadsController', function ($scope, $http, $rootScope, $ngBootbox) {

    $ngBootbox.setLocale('es');

    $scope.q = {
        'q': '',
        'qtipoTarjetaAprobados': '',
        'qcityAprobados': '',
        'qleadChannel': '',
        'qfechaInicialAprobados': '',
        'qfechaFinalAprobados': '',
        'qCM': '',
        'qRL': '',
        'qGen': '',
        'qfechaInicialTR': '',
        'qfechaFinalTR': '',
        'qTRAnt': '',
        'initFrom': 0,
        'initFromAnt': 0,
        'initFromCM': 0,
        'initFromRL': 0,
        'initFromGen': 0,
        'initFromTR': 0,
        'initFromAL': 0,
        'city': '',
        'fecha_ini': '',
        'fecha_fin': '',
        'typeService': '',
        'state': '',
        'channel': '',
    };

    $scope.codeAsesor = "";
    $scope.tabs = 1;
    $scope.totalLeads = 0;
    $scope.totalLeadsAnt = 0;
    $scope.totalLeadsRejected = 0;
    $scope.totalLeadsCM = 0;
    $scope.totalLeadsGen = 0;
    $scope.totalLeadsTR = 0;
    $scope.totalLeadsTRAnt = 0;
    $scope.cargando = true;
    $scope.cargandoAnt = true;
    $scope.cargandoCM = true;
    $scope.cargandoRL = true;
    $scope.cargandoGen = true;
    $scope.cargandoTR = true;
    $scope.filtros = false;
    $scope.viewAddComent = false;
    $scope.lead = {};
    $scope.idLead = '';

    $scope.socialNetworks = [{
        label: 'WHATSAPP',
        value: 3
    }];


    $scope.leadsChannels = [{
        label: 'FACEBOOK',
        value: 2
    },
    {
        label: 'WHATSAPP',
        value: 3
    }
    ];

    $scope.comment = {
        comment: '',
        idLead: 0,
        state: 0
    };

    $scope.comments = [];
    $scope.leads = [];
    $scope.leadsAnt = [];
    $scope.leadsCM = [];
    $scope.leadsGen = [];
    $scope.leadsRejected = [];
    $scope.leadsTR = [];
    $scope.cities = [];

    $scope.typeServices = [{
        label: 'Crédito',
        value: 'Crédito'
    },
    {
        label: 'Crédito Motos',
        value: 'Motos'
    },
    {
        label: 'Crédito Libranza',
        value: 'Credito libranza'
    },
    {
        label: 'Seguros',
        value: 'Seguros'
    },
    ];

    $scope.typeStates = [{
        label: 'Pendiente',
        value: 0
    },
    {
        label: 'En estudio',
        value: 1
    },
    {
        label: 'En espera',
        value: 2
    },
    {
        label: 'Aprobado',
        value: 3
    },
    {
        label: 'Negado',
        value: 4
    }
    ];

    $scope.cardTypes = [{
        label: 'Tarjeta Black',
        value: 0
    },
    {
        label: 'Tarjeta Gray',
        value: 1
    }
    ];

    $scope.getCities = function () {
        $http({
            method: 'GET',
            url: '/subsidiaries/cities'
        }).then(function successCallback(response) {
            console.log(response.data);
            if (response.data != false) {
                $scope.cities = response.data;
            }
        }, function errorCallback(response) {
            console.log(response);
        });
    };

    $scope.getLeads = function () {
        showLoader();
        $scope.cargando = true;
        $scope.cargandoAnt = true;
        $scope.cargandoCM = true;
        $scope.cargandoRL = true;
        $scope.cargandoGen = true;
        $scope.cargandoTR = true;


        $http({
            method: 'GET',
            url: '/leads?q=' + $scope.q.q +
                '&qtipoTarjetaAprobados=' + $scope.q.qtipoTarjetaAprobados +
                '&qcityAprobados=' + $scope.q.qcityAprobados +
                '&qleadChannel=' + $scope.q.qleadChannel +
                '&qfechaInicialAprobados=' + $scope.q.qfechaInicialAprobados +
                '&qfechaFinalAprobados=' + $scope.q.qfechaFinalAprobados + $scope.q.qcityAprobados +
                '&qfechaInicialTR=' + $scope.q.qfechaInicialTR +
                '&qfechaFinalTR=' + $scope.q.qfechaFinalTR +
                '&qCM=' + $scope.q.qCM +
                '&qRL=' + $scope.q.qRL +
                '&qGen=' + $scope.q.qGen +
                '&initFrom=' + $scope.q.initFrom +
                '&initFromAnt=' + $scope.q.initFromAnt +
                '&initFromCM=' + $scope.q.initFromCM +
                '&initFromRL=' + $scope.q.initFromRL +
                '&initFromGen=' + $scope.q.initFromGen +
                '&initFromTR=' + $scope.q.initFromTR +
                '&initFromAL=' + $scope.q.initFromAL +
                '&city=' + $scope.q.city +
                '&fecha_ini=' + $scope.q.fecha_ini +
                '&fecha_fin=' + $scope.q.fecha_fin +
                '&typeService=' + $scope.q.typeService +
                '&state=' + $scope.q.state +
                '&channel' + $scope.q.channel,

        }).then(function successCallback(response) {
            console.log(response.data);

            $scope.codeAsesor = response.data.codeAsesor;
            $scope.totalLeads = response.data.totalLeads;
            $scope.totalLeadsAnt = response.data.totalLeadsAnt;
            $scope.totalLeadsRejected = response.data.totalLeadsRejected;
            $scope.totalLeadsCM = response.data.totalLeadsCM;
            $scope.totalLeadsGen = response.data.totalLeadsGen;
            $scope.totalLeadsTR = response.data.totalLeadsTR;


            if (response.data.leadsDigital != false) {
                $scope.q.initFrom += response.data.leadsDigital.length;
                angular.forEach(response.data.leadsDigital, function (value, key) {
                    $scope.leads.push(value);
                });
                $scope.cargando = false;
            }

            if (response.data.leadsDigitalAnt != false) {
                $scope.q.initFromAnt += response.data.leadsDigitalAnt.length;
                angular.forEach(response.data.leadsDigitalAnt, function (value, key) {
                    $scope.leadsAnt.push(value);
                });
                $scope.cargandoAnt = false;
            }

            if (response.data.leadsTR != false) {
                $scope.q.initFromTR += response.data.leadsTR.length;
                angular.forEach(response.data.leadsTR, function (value, key) {
                    $scope.leadsTR.push(value);
                });
                $scope.cargandoTR = false;
            }

            if (response.data.leadsGen != false) {
                $scope.q.initFromGen += response.data.leadsGen.length;
                angular.forEach(response.data.leadsGen, function (value, key) {
                    $scope.leadsGen.push(value);
                });
                $scope.cargandoGen = false;
            }

            if (response.data.leadsCM != false) {
                $scope.q.initFromCM += response.data.leadsCM.length;
                angular.forEach(response.data.leadsCM, function (value, key) {
                    $scope.leadsCM.push(value);
                });
                $scope.cargandoCM = false;
            }

            hideLoader();
        }, function errorCallback(response) {
            console.log(response);
        });
    };

    $scope.searchLeads = function () {
        $scope.q.initFrom = 0;
        $scope.q.initFromAnt = 0;
        $scope.q.initFromCM = 0;
        $scope.q.initFromGen = 0;
        1
        $scope.q.initFromTR = 0;
        $scope.q.initFromTRAnt = 0;
        $scope.leads = [];
        $scope.leadsAnt = [];
        $scope.leadsCM = [];
        $scope.leadsTR = [];
        $scope.leadsGen = [];
        $scope.leadsRejected = [];
        $scope.getLeads();
    };

    $scope.resetFiltros = function () {
        $scope.leads = [];
        $scope.leadsAnt = [];
        $scope.leadsCM = [];
        $scope.leadsTR = [];
        $scope.leadsGen = [];
        $scope.q = {
            'q': '',
            'qtipoTarjetaAprobados': '',
            'qcityAprobados': '',
            'qleadChannel': '',
            'qfechaInicialAprobados': '',
            'qfechaFinalAprobados': '',
            'qCM': '',
            'qRL': '',
            'qGen': '',
            'qfechaInicialTR': '',
            'qfechaFinalTR': '',
            'qTRAnt': '',
            'initFrom': 0,
            'initFromAnt': 0,
            'initFromCM': 0,
            'initFromRL': 0,
            'initFromGen': 0,
            'initFromTR': 0,
            'initFromAL': 0,
            'city': '',
            'fecha_ini': '',
            'fecha_fin': '',
            'typeService': '',
            'state': '',
            'channel': '',
        };
        $scope.filtros = false;
        $scope.getLeads();
    };

    $scope.vewLead = function (lead) {
        $scope.lead = lead;
        $("#viewLead").modal("show");
    };

    $scope.showUpdateDialog = function (idLead) {
        $scope.idLead = idLead;
        $scope.viewCommunityLeads($scope.idLead);
        $('#updateCommunityModal').modal('show');
    };

    $scope.viewCommunityLeads = function (idLead) {
        $http({
            method: 'GET',
            url: '/communityLeads/viewCommunityLeads/' + idLead
        }).then(function successCallback(response) {
            if (response.data != false) {
                $scope.lead = response.data;
            }
        },
            function errorCallback(response) { });
    };

    $scope.updateCommunityLeads = function () {
        $http({
            method: 'POST',
            url: '/communityLeads/updateCommunityLeads',
            data: $scope.lead
        }).then(function successCallback(response) {
            console.log(response);
            if (response.data != false) {
                $scope.searchLeads();
                $('#updateCommunityModal').modal('hide');
            }
        }, function errorCallback(response) {
            console.log(response);
        });
    }

    $scope.addCommunityForm = function () {
        $scope.lead = {};
        $("#addCommunityLead").modal("show");
    };

    $scope.addCommunityLeads = function () {
        $http({
            method: 'POST',
            url: '/communityLeads/addCommunityLeads',
            data: $scope.lead
        }).then(function successCallback(response) {
            console.log(response);
            if (response.data != false) {
                $scope.searchLeads();
                $('#addCommunityLead').modal('hide');
                $scope.lead = {};
            }
        }, function errorCallback(response) {
            console.log(response);
        });
    };


    $scope.assignAssesorDigitalToLead = function (solicitud) {
        $ngBootbox.confirm('Desea hacer la gestión de este lead ?')
            .then(function () {
                showLoader();
                $http({
                    method: 'GET',
                    url: '/api/canalDigital/assignAssesorDigitalToLead/' + solicitud,
                }).then(function successCallback(response) {
                    console.log(response);
                    $scope.searchLeads();
                    hideLoader();
                }, function errorCallback(response) {
                    hideLoader();
                    console.log(response);
                });
            });
    };


    $scope.assignAssesorDigitalToLeadCM = function (solicitud) {
        $ngBootbox.confirm('Desea hacer la gestión de este lead ?')
            .then(function () {
                showLoader();
                $http({
                    method: 'GET',
                    url: '/api/canalDigital/assignAssesorDigitalToLeadCM/' + solicitud,
                }).then(function successCallback(response) {
                    console.log(response);
                    $scope.searchLeads();
                    hideLoader();
                }, function errorCallback(response) {
                    hideLoader();
                    console.log(response);
                });
            });
    };

    $scope.checkLeadProcess = function (idLead) {
        $ngBootbox.confirm('Desea marcar a este lead como procesado ?')
            .then(function () {
                showLoader();
                $http({
                    method: 'GET',
                    url: '/api/canalDigital/checkLeadProcess/' + idLead,
                }).then(function successCallback(response) {
                    $scope.searchLeads();
                    hideLoader();
                }, function errorCallback(response) {
                    console.log(response);
                });
            });
    }

    $scope.viewComments = function (name, lastName, state, idLead, init = true) {
        $scope.comments = [];
        $scope.idLead = idLead;
        $http({
            method: 'GET',
            url: '/api/leads/getComentsLeads/' + idLead
        }).then(function successCallback(response) {
            if (response.data != false) {
                angular.forEach(response.data, function (value, key) {
                    $scope.comments.push(value);
                });
            }

            if (init) {
                $("#viewComments").modal("show");
                $scope.nameLead = name;
                $scope.lastNameLead = lastName;
                $scope.state = state;
            }
        }, function errorCallback(response) {
            console.log(response);

        });
    };

    // get a comments for a community manager lead and show a modal
    $scope.viewCommentsCM = function (name, lastName, state, idLead, init = true) {
        $scope.comments = [];
        $scope.idLead = idLead;
        $http({
            method: 'GET',
            url: '/api/leads/getComentsLeads/' + idLead
        }).then(function successCallback(response) {
            if (response.data != false) {
                angular.forEach(response.data, function (value, key) {
                    $scope.comments.push(value);
                });
            }

            if (init) {
                $("#viewCommentsCM").modal("show");
                $scope.nameLead = name;
                $scope.lastNameLead = lastName;
                $scope.state = state;
            }
        }, function errorCallback(response) {

        });
    };

    $scope.viewCommentChange = function () {
        $scope.viewAddComent = !$scope.viewAddComent;
    };

    $scope.addComment = function () {
        $scope.comment.idLead = $scope.idLead;
        $http({
            method: 'GET',
            url: '/Admin/Comments/api/leads/addComent/' + $scope.comment.idLead + '/' + $scope.comment.comment
        }).then(function successCallback(response) {
            console.log(response);
            if (response.data != false) {
                $scope.viewComments($scope.lead.name, $scope.lead.lastName, $scope.state, $scope.idLead, false);
                $scope.comment.comment = "";
                $scope.viewAddComent = false;
            }
        }, function errorCallback(response) {
            console.log(response);
        });
    };

    //store a community manager lead comment and reload a comments
    $scope.addCommentCM = function () {
        $scope.comment.idLead = $scope.idLead;
        $http({
            method: 'GET',
            url: '/api/leads/addComent/' + $scope.comment.idLead + '/' + $scope.comment.comment
        }).then(function successCallback(response) {
            if (response.data != false) {
                $scope.viewComments($scope.lead.NOMBRES, $scope.lead.APELLIDOS, $scope.state, $scope.idLead, false);
                $scope.comment.comment = "";
                $scope.viewAddComent = false;
            }
        }, function errorCallback(response) { });
    };

<<<<<<< HEAD

    $scope.showDialogDelete = function (idLead) {
        $scope.idLead = idLead;
        $('#deleteCommunityModal').modal("show");
    }


    $scope.confirmDelete = function () {
        $scope.deleteCommunityLeads($scope.idLead);
    }

    $scope.cancelDelete = function () {
        $('#deleteCommunityModal').modal('hide');
    }

    $scope.deleteCommunityLeads = function (idLead) {
            $http({
            method: 'POST',
            url: '/communityLeads/deleteCommunityLeads/' + idLead
                  }).then(function successCallback(response) {
                      if (response.data != false) {
                              $scope.searchLeads();
                $('#deleteCommunityModal').modal('hide');
            }
        }, function errorCallback(response) {
            console.log(response);

        });
    }

=======
      $scope.showDialogDelete = function (idLead) {
          $scope.idLead = idLead;
          $('#deleteCommunityModal').modal("show");
      }


      $scope.confirmDelete = function () {
          $scope.deleteCommunityLeads($scope.idLead);
      }

      $scope.cancelDelete = function () {
          $('#deleteCommunityModal').modal('hide');
      }

      $scope.deleteCommunityLeads = function (idLead) {
          $http({
              method: 'POST',
              url: '/communityLeads/deleteCommunityLeads/' + idLead
          }).then(function successCallback(response) {
              if (response.data != false) {
                  $scope.searchLeads();
                  $('#deleteCommunityModal').modal('hide');
              }
          }, function errorCallback(response) {});
      }
>>>>>>> b504c86008bdc7920b6fdc8c631a1e78ce52aed3

    $scope.getLeads();
    $scope.getCities();
})


// 5691
