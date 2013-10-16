(function() {
  var oClientSearchAF, oClientSearchPage, oSubsSearchAF, oSubsSearchPage, oWizard;
  oWizard = new BiWizard("Default wizard");
  oClientSearchPage = new BiComponent();
  oSubsSearchPage = new BiComponent();
  oClientSearchAF = icms.user.getSubsystem("SBMS_CONTACT_INFO").getForm("CONTACT_CARD");
  oClientSearchAF.form_type = icms.afType.aftBiInline;
  oClientSearchAF.mode = icms.afMode.afmEmbed;
  oSubsSearchAF = icms.user.getSubsystem("SBMS_SUBS_CARD").getForm("SubsSelection");
  oSubsSearchAF.form_type = icms.afType.aftBiInline;
  oSubsSearchAF.mode = icms.afMode.afmEmbed;
  oWizard.addPage(oClientSearchPage);
  oWizard.addPage(oSubsSearchPage);
  oSubsSearchAF.display(oSubsSearchPage);
  oClientSearchAF.display(oClientSearchPage);
  oWizard.addEventListener("next", function(ev) {
    return alert("Next page!!! " + ev);
  });
  oWizard.setSize(800, 600);
  oWizard.setVisible(true);
  oWizard.next();
}).call(this);
