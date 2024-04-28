import base64
 
random_thing = "R290IHRoZSBzdXBlciBzZWNyZXQgR1JBUEUhIPCfjYc="
random_things = "MS]7_]W&=b=M_^;X@iLcZ>??("

def out_txt(in_txt):
    return ''.join([chr((ord(char) - 10 - 32) % 95 + 32) if 32 <= ord(char) <= 126 else char for char in in_txt])

wallet = 100
while True:   
    print()
    print("Welcome to the yet another fruit store!")
    print("We are selling our last, premium 'Super Secret Fruit' for today only!")
    print("But it is really expensive...")
    print("Or is it?")
    print()
    print("1) Orange (RM 5)")
    print("2) Banana (RM 10)")
    print("3) Strawberry (RM 20)")
    print("4) Super Secret Fruit (RM1000)")

    print(f"Your wallet: RM{wallet}")

    x = (input("Enter your choice: "))
    try:
        x = int(x)
    except ValueError:
        print("Invalid choice. Please enter a number.")
        continue;
        
    if 1 <= x <= 4:
        y = (input("Enter how many fruits you want to buy: "))
        cost = 0
        fruit_price = 0
        if x == 1:
            fruit_price = 5
        elif x == 2:
            fruit_price = 10
        elif x == 3:
            fruit_price = 20
        elif x == 4:
            fruit_price = 1000
            
        
        proceed = True;
        try:
            try:
                y = int(y)
                if (y <= 0):
                    proceed = False
            except ValueError:
                pass
            
            if (proceed):
                exec(f'cost = {fruit_price} * {y}')
                wallet -= cost
                if wallet >= 0:
                    print(f"Total cost: RM{cost}")
                    print(f"Remaining balance: RM{wallet}")
                    if (x == 4):
                        print()
                        print(base64.b64decode(random_thing).decode('utf-8'))
                        print(out_txt(random_things))
                    break
                    print("#PS: Still normal fruits, nothing much")
                else:
                    print("Insufficient funds.")
            else:
                print("Please enter something more than 0!")
        except Exception as e:
            print("You insert something you should't!")   
    else:
        print("Invalid choice.")
        

    print()
    y = input("Press ENTER to continue ...")
    print()

