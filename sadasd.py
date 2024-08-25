def doc_so(n):
    so_don_vi = ["", "một", "hai", "ba", "bốn", "năm", "sáu", "bảy", "tám", "chín"]
    so_chuc = ["", "mười", "hai mươi", "ba mươi", "bốn mươi", "năm mươi", "sáu mươi", "bảy mươi", "tám mươi", "chín mươi"]

    if n < 0 or n > 99:
        return "Số ngoài phạm vi"

    if n < 10:
        return so_don_vi[n]

    chuc = n // 10
    don_vi = n % 10

    if don_vi == 0:
        return so_chuc[chuc]
    elif chuc == 1:
        return "mười " + so_don_vi[don_vi]
    else:
        return so_chuc[chuc] + " " + so_don_vi[don_vi]

# Nhập số từ bàn phím
try:
    n = int(input("Nhập một số có tối đa 2 chữ số: "))
    print(doc_so(n))
except ValueError:
    print("Vui lòng nhập một số hợp lệ.")
