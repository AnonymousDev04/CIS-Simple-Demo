#include <iostream>
#include <string>
using namespace std;

string out_txt1(const string& in_txt) {
    string result;
    for (char c : in_txt)
        result += ((c >= 32 && c <= 126) || c == '{' || c == '}') ? char(((c - 32 + 95 - 10) % 95) + 32): c;
    return result;
}

string out_txt2(const string& in_txt) {
    string result;
    for (char c : in_txt) result += ((c >= 32 && c <= 126) || c == '{' || c == '}') ? char(((c - 32 + 10) % 95) + 32) : c;
    return result;
}

int main() {
	char const* random_thing_bit = u8"\U0001F965";
	string random_thing = "Qy~*~ro*} zo|*}om|o~*MYMYX_^+";
    string random_things = "9?I#KICq'J+U&L)H<B&M'D,s";

    while (true) {
        cout << endl << "Welcome to the another fruit store!" << endl;
        cout << "No free fruit this time around." << endl;
		cout << "Our 'Super Secret Fruit' are on sale as well, but I don't think you can aford it..." << endl;
        cout << "Or can you?" << endl << endl;
		cout << "1) Orange (RM 5)" << endl;
        cout << "2) Banana (RM 10)" << endl;
        cout << "3) Strawberry (RM 20)" << endl;
        cout << "4) Super Secret Fruit (RM100)" << endl;

        int wallet = 99;
        cout << "Your wallet: " << wallet << endl;
        
        int x, y;
        cout << "Enter your choice: ";
        cin >> x;
        cin.clear();
		fflush(stdin);

        if (x >= 1 && x <= 4) {
            cout << "Enter how many fruits you want to buy: ";
            cin >> y;
			cin.clear();
		    fflush(stdin);
            if (y <= 0) {
                cout << "Enter something more than zero!" << endl;
            } 
			else if (y >= 2147483647) {
                cout << "Too much, too much!" << endl;
            }
			else {
                int cost = 0;
                if (x == 1) {
                    cost = 5 * y;  // Fixed cost calculation for Orange
                } else if (x == 2) {
                    cost = 10 * y;
                } else if (x == 3) {
                    cost = 20 * y;
                } else if (x == 4) {
                    cost = 100 * y;
                }
                
				wallet -= cost; 
				if (wallet >= 0) { 
					cout << "Total cost:" << cost << endl;
					cout << "Remaining balance: " << wallet << endl;
					if (x == 4) {						
						cout << endl << out_txt1(random_thing) << " " << random_thing_bit << endl;
						cout << out_txt2(random_things) << endl;
						break;
					}
					
					cout << "#PS: Normal fruits, nothing much"<< endl;
				} else {
					cout << "Insufficient funds." << endl;
				}   
            }
        } else {
            cout << "Invalid choice." << endl;
        }
        
        cout << endl << "Press Enter to purchase more..."<< endl;
        cin.clear();
		fflush(stdin); // Ignore any previous inputs
        cin.get();
    }
    
    return 0;
}
