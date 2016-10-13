Sub FormatText()
' The purpose of this Macro is to set up an excel spreadsheet in order for
' it to be properly mapped to be exported into an CRM application.
    ' Some variables to use.
    Dim fName As String
    Dim lName As String
    Dim LastRow As Long
    Dim LastCell As Long
    Dim i As Long
    Dim x As Long
    
    ' Get the last Row in the worksheet.
    LastRow = Cells(Rows.Count, 1).End(xlUp).Row
    ' Start the loop for each row.
    For i = 1 To LastRow
        ' Grab how many cells that are in the current row.
        LastCell = Cells(i, "IV").End(xlToLeft).Column
        ' Start the loop through each Cell.
        For x = 1 To LastCell
            ' Look for the consistant tag for each technician to grab Name.
            If ActiveCell = "HOPE NETWORK WEST MICHIGAN" Then
                lName = ActiveCell.Offset(0, -2).Value
                fName = ActiveCell.Offset(0, -1).Value
                ' Delete the cell.
                Selection.Delete Shift:=xlToLeft
            ' Check for the Service, then drops in the name of the Technician.
            ElseIf ActiveCell.Value Like "HC:H*" Then
                ' Checl to see if this is the technicians first service of the row, so to not duplicate entry
                If ActiveCell.Offset(0, -2).Value = fName Then
                    ActiveCell.Offset(0, 1).Select
                Else
                    ' Step back 1 cell to drop before date of service.
                    ActiveCell.Offset(0, -1).Select
                    ' Insert 2 cells.
                    Selection.Insert Shift:=xlToRight, CopyOrigin:=xlFormatFromLeftOrAbove
                    Selection.Insert Shift:=xlToRight, CopyOrigin:=xlFormatFromLeftOrAbove
                    ' drop in data.
                    ActiveCell.Value = lName
                    ActiveCell.Offset(0, 1).Value = fName
                    ' Go back to the next cell that should be checked.
                    ActiveCell.Offset(0, 4).Select
                End If
            ' Delete the blank cells that seperate the next technician group.
            ElseIf ActiveCell.Value = "" Then
                Selection.Delete Shift:=xlToLeft
            ' If nothing is to do done, Skip to next cell.
            Else
                ActiveCell.Offset(0, 1).Select
            End If
        Next x
        ' End of row, go to the beginning of next row to start.
        Cells(i + 1, 1).Select
    Next i
End Sub



