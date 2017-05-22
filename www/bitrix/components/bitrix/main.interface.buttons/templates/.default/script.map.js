{"version":3,"file":"script.min.js","sources":["script.js"],"names":["BX","namespace","Main","interfaceButtons","container","params","this","classItem","classItemSublink","classItemText","classItemCounter","classItemIcon","classItemMore","classOnDrag","classDropzone","classSeporator","classSubmenuItem","classItemDisabled","classItemOver","classItemActive","classSubmenu","classSecret","classItemLocked","submenuIdPrefix","submenuWindowIdPrefix","listContainer","submenuContainer","pinContainer","dragItem","overItem","moreButton","messages","licenseParams","isSubmenuShown","isSubmenuShownOnDragStart","tmp","init","getItemById","delegate","getAllItems","getHiddenItems","getVisibleItems","getDisabledItems","getMoreButton","adjustMoreButtonPosition","adjustSubmenuPosition","showSubmenu","closeSubmenu","refreshSubmenu","getCurrentSettings","saveSettings","setCounterValueByItemId","getCounterValueByItemId","classes","item","itemText","itemCounter","itemIcon","itemDisabled","itemOver","itemActive","itemLocked","submenu","submenuItem","containerOnDrag","itemsContainer","itemsContainerId","id","prototype","setListContainer","type","isPlainObject","isNotEmptyString","containerId","isDomNode","setCustomClasses","setMessages","licenseWindow","setLicenseWindowParams","visibleControllMoreButton","dragAndDropInit","bindOnClickOnMoreButton","createFrame","bindOnResizeFrame","bindOnScrollWindow","bindOnClick","createSubmenu","setSubmenuContainer","getSubmenuContainer","setContainerHeight","setParentPinContainer","bind","window","_onScroll","findParentByClassName","getContainerHeight","allItems","heights","currentStyle","map","call","current","getComputedStyle","height","parseInt","marginTop","marginBottom","Math","max","apply","containerHeight","message","messageId","result","error","itemSublink","itemMore","onDrag","dropzone","seporator","secret","makeFullItemId","itemId","replace","join","resultItem","realId","findChild","attribute","getItemCounterObject","class","setCounterValue","value","counter","innerText","dataset","counterValue","currentValue","parseFloat","currentItem","aliasItem","isNumber","console","info","getItemAlias","NaN","dataValue","_onClickMoreButton","maininterfacebuttonstmpframe","onresize","throttle","_onResizeHandler","self","length","forEach","_onClick","frame","create","props","width","name","style","position","z-index","opacity","parentNode","appendChild","children","visibleItems","filter","isVisibleItem","isDisabled","hiddenItems","disabledItems","hasClass","getLastVisibleItem","lastVisibleItem","isArray","isLast","isMoreButton","isNext","offsetTop","nextSiblingItem","findNextSiblingByClass","insertBefore","getSubmenuId","isFull","getSubmenuItemText","text","findChildrenByClassName","outerHTML","submenuWindow","bindElement","bindElementPosition","getSubmenu","popupWindow","document","getElementById","getBindElementPos","adjustPosition","getLockedClass","isLocked","getSubmenuItems","indexOf","push","href","className","getIconClass","getAliasLink","getSubmenuArgs","menuId","anchor","anchorPosition","pos","menuItems","autoHide","offsetLeft","angle","offset","events","onPopupClose","_onSubmenuClose","onPopupShow","dragAndDropInitInSubmenu","hide","show","args","PopupMenu","setSubmenuShown","activateItem","close","deactivateItem","getMenuById","destroySubmenu","destroy","isBoolean","addClass","removeClass","settings","index","sort","paramName","JSON","stringify","userOptions","save","moveButtonAlias","aliasDragItem","isListItem","moveButton","disabled","isSubmenuItem","enableItem","sourceItem","nextSibling","findChildren","draggable","tabindex","link","_onMouse","_onDragStart","_onDragEnd","_onDragEnter","_onDragOver","_onDragLeave","submenuItems","layout","sortable","isDropzone","_onDrop","getItem","event","target","setOpacity","unsetOpacity","setDragStyles","unsetDragStyles","items","disableItem","alias","hideItem","showItem","fakeDragItem","isDragToSubmenu","updateSubmenuItems","moved","isDragToList","some","concat","someEl","isSeporator","setOverStyles","unsetOverStyles","key","tmpResult","data","execScript","script","eval","showLicenseWindow","popup","B24","licenseInfoPopup","B24_LICENSE_BUTTON_TEXT","B24_TRIAL_BUTTON_TEXT","IS_FULL_DEMO_EXISTS","isFullDemoExists","HOST_NAME","hostname","AJAX_URL","ajaxUrl","LICENSE_ALL_PATH","licenseAllPath","LICENSE_DEMO_PATH","licenseDemoPath","FEATURE_GROUP_NAME","featureGroupName","AJAX_ACTIONS_URL","ajaxActionsUrl","B24_FEATURE_TRIAL_SUCCESS_TEXT","preventDefault","isGoodPosition","previousElementSibling","dataOnclick","isSublink","isOvered","dragItemRect","getBoundingClientRect","overItemRect","styles","dragItemMarginRight","marginRight","clientX","left","right","clientY","top","interfaceButtonsManager","getById","isString","e"],"mappings":"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"}