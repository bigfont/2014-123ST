var currentMenu = 0;		
		function SubMenu1 () {
			

				if (currentMenu == 1) {
						//Menu1 is up, so just drop it
						new Effect.Move ('mainmenu',{ x: 0, y: 21, mode: 'absolute', duration: .5, afterFinish: SubOne, queue: {position:'end', scope: 'scroll'}});
						currentMenu = 0;
				} else {
						//Drop and then move and lift
						if (currentMenu > 0) {
							new Effect.Move ('mainmenu',{ x: 0, y: 21, mode: 'absolute', duration: .5, afterFinish: SubOne, queue: {position:'end', scope: 'scroll'}});
							new Effect.Move ('mainmenu',{ x: 0, y: 3, mode: 'absolute', duration: .5,  queue: {position:'end', scope: 'scroll'}});
						} else {
							new Effect.Move ('mainmenu',{ x: 0, y: 21, mode: 'absolute', duration: 0, afterFinish: SubOne, queue: {position:'end', scope: 'scroll'}});
							new Effect.Move ('mainmenu',{ x: 0, y: 3, mode: 'absolute', duration: .5, queue: {position:'end', scope: 'scroll'}});
						}
						currentMenu = 1;
				}
								
		}
		function SubMenu2 () {

				if (currentMenu == 2) {
						//Menu2 is up, so just drop it
						new Effect.Move ('mainmenu',{ x: 0, y: 21, mode: 'absolute', duration: .5, afterFinish: SubTwo, queue: {position:'end', scope: 'scroll'}});
						currentMenu = 0;
				} else {
						//Drop and then move and lift
						if (currentMenu > 0) {
							new Effect.Move ('mainmenu',{ x: 0, y: 21, mode: 'absolute', duration: .5, afterFinish: SubTwo, queue: {position:'end', scope: 'scroll'}});
							new Effect.Move ('mainmenu',{ x: 0, y: 3, mode: 'absolute', duration: .5,  queue: {position:'end', scope: 'scroll'}});
						} else {
							new Effect.Move ('mainmenu',{ x: 0, y: 21, mode: 'absolute', duration: 0, afterFinish: SubTwo, queue: {position:'end', scope: 'scroll'}});
							new Effect.Move ('mainmenu',{ x: 0, y: 3, mode: 'absolute', duration: .5, queue: {position:'end', scope: 'scroll'}});
						}
						currentMenu = 2;
				}

		}
		
		function SubMenu3 () {

				if (currentMenu == 3) {
						//Menu2 is up, so just drop it
						new Effect.Move ('mainmenu',{ x: 0, y: 21, mode: 'absolute', duration: .5, afterFinish: SubThree, queue: {position:'end', scope: 'scroll'}});
						currentMenu = 0;
				} else {
						//Drop and then move and lift
						if (currentMenu > 0) {
							new Effect.Move ('mainmenu',{ x: 0, y: 21, mode: 'absolute', duration: .5, afterFinish: SubThree, queue: {position:'end', scope: 'scroll'}});
							new Effect.Move ('mainmenu',{ x: 0, y: 3, mode: 'absolute', duration: .5,  queue: {position:'end', scope: 'scroll'}});
						} else {
							new Effect.Move ('mainmenu',{ x: 0, y: 21, mode: 'absolute', duration: 0, afterFinish: SubThree, queue: {position:'end', scope: 'scroll'}});
							new Effect.Move ('mainmenu',{ x: 0, y: 3, mode: 'absolute', duration: .5, queue: {position:'end', scope: 'scroll'}});
						}
						currentMenu = 3;
				}

		}
		
		function SubOne () {
				new Element.show ('SubOne');
				new Element.hide ('SubTwo');
				new Element.hide ('SubThree');
		}
		function SubTwo () {
				new Element.hide ('SubOne');
				new Element.hide ('SubThree');
				new Element.show ('SubTwo');
		}
		function SubThree () {
				new Element.hide ('SubOne');
				new Element.hide ('SubTwo');
				new Element.show ('SubThree');
		}
		
		function Move() {
			
		}