{"version":3,"file":"settings-window.min.js","sources":["settings-window.js"],"names":["BX","namespace","Grid","SettingsWindow","parent","this","settingsButton","applyBottom","items","popup","sourceContent","lastColumns","init","prototype","bind","getContainer","proxy","_onContainerClick","addCustomEvent","window","_onColumnMoved","reset","allColumns","showedColumns","destroy","unbind","removeCustomEvent","getPopup","close","event","hasClass","target","settings","get","_onSettingsButtonClick","show","getSourceContent","Utils","getByClass","getPopupItems","popupContainer","contentContainer","getColumns","columns","checkbox","forEach","current","findColumnCheckbox","checked","push","data","restoreColumns","getParam","name","label","findColumnLabel","defaultColumn","default","html","util","htmlspecialchars","sortItems","restoreLastColumns","indexOf","saveColumns","callback","options","getUserOptions","columnNames","getColumnNames","forAll","isForAll","tableFade","setColumns","setColumnsNames","saveForAll","reloadTable","resetSettings","button","confirmOptions","CONFIRM","CONFIRM_MESSAGE","arParams","CONFIRM_RESET_MESSAGE","getActionsPanel","confirmDialog","delegate","addClass","buttonNode","removeClass","popupWindow","enableColumnLabelEdit","contentEditable","adjustCaret","focus","disableColumnLabelEdit","disableAllColumnslabelEdit","column","enableCheckbox","isColumnLabelEditEnabled","isContentEditable","isEditButton","element","getByTag","getBySelector","disableCheckbox","disabled","childNodes","length","range","document","createRange","selection","getSelection","elementTextLength","innerText","textNodes","lastTextNode","setStart","setEnd","collapse","removeAllRanges","addRange","_onColumnClick","currentTarget","_onColumnKeydown","code","input","value","getAllColumns","map","item","getShowedColumns","call","getRows","getHeadFirstChild","getCells","isShowedColumn","columnName","some","counter","Object","keys","getColumnByName","parentNode","appendChild","htmlspecialcharsback","trim","self","tmpDiv","create","innerHTML","titleBar","firstChild","PopupWindow","getContainerId","autoHide","overlay","width","closeIcon","closeByEsc","contentNoPaddings","events","onPopupClose","buttons","PopupWindowButtonLink","text","id","className","click","PopupWindowButton","getForAllCheckbox","createCheckbox","resetButton","getResetButton","insertAfter","setContent","decl","block","mix","tag","content","attrs","type","for"],"mappings":"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"}