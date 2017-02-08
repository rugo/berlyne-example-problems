from shutil import copyfile

def main(flag):
    copyfile("./data.png" , "./data-secret.png")
    with open("./data-secret.png","a") as f:
         f.write(flag)

main("flag{qwertzqwertzqwertz}")
