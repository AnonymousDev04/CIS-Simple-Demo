import base64
 
random_thing = "R290IHRoZSBzdXBlciBzZWNyZXQgV0FURVJNRUxPTiEg8J+NiQ=="
random_things = "MS]7_]W&;VV:Q;M>VVciV:Q;M>V("

lowercase = list(map(chr, range(ord('a'), ord('z') + 1)))
uppercase = list(map(chr, range(ord('A'), ord('Z') + 1)))
symbols = ['', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '-', '_', '=', '+', '[', ']', '{', '}', '|', ';', ':', '<', '>', ',', '.', '/', '?', "'", '"', '\\', '`', '~']

numeric = ['0', '4', '5', '6', '7', '8', '9']

def out_txt(in_txt):
    return ''.join([chr((ord(char) - 10 - 32) % 95 + 32) if 32 <= ord(char) <= 126 else char for char in in_txt])
    
def print_out_f(input_txt):
    output_txt = ''
    for char in input_txt:
        output_char = chr(ord(char) - 21)
        output_txt += output_char
    return output_txt
    
while True:
    print()
    print("Welcome to the fruit store!")
    print("You may pick one for free, but not our 'Super Secret Fruit'...") 
    print("Or can you?")
    print()
    print("1) Orange")
    print("2) Banana")
    print("3) Strawberry")
    print("?) Super Secret Fruit")

    x = input("Enter your choice: ").strip()
    x = x[0]

    # Check if x is empty after stripping
    if not x:
        print("No input provided.")
    elif x in lowercase or x in uppercase or x in symbols or x in numeric:
        print(f"{x} is not valid. Please enter valid input (Numeric (1-3))")
    elif x == '1':
        print('Yeah.. an orange. Nothing interesting here.')
        pass
    elif x == '2':
        print('Simple, plain banana.')
        pass
    elif x == '3':
        print('Quite a bright red strawberry. That\'s all.')
        pass
    else:
        print()
        print(base64.b64decode(random_thing).decode('utf-8'))
        print(out_txt(random_things))
        break
        
    print()
    y = input("Press ENTER to continue ...")
    print()
