// import React from 'react'
// import Reply from './reply';

class OneComment extends React.Component {
    constructor(){
        super()
        this.state= {
            comment: "",
            isEditing: false,
            thisButtonClicked: false,
            reply: true
        }
    }

    render(){
        let {id, deleteFunc, editHandler, index} = this.props 
        console.log(index, "index form props")

        return(
            <div>
                <input value={this.state.comment} name="comment" onChange={this.changeHandler} onClick={this.onEditHandeler}/>

                {this.state.thisButtonClicked === false ? <div onClick={() =>deleteFunc(index)} className="editanddelete" ><i className="fas fa-trash-alt" ></i></div> :
                <div className="editanddelete" name="editButton" onClick={this.sendNewObj}><i className="far fa-edit"></i></div>}
                <button name="replybutton" onClick={this.changeHandler}>reply</button>
                {this.state.reply === false ? <Reply addComment={this.props.addComment}/> : null}
            </div>
        )
    }

    changeHandler = (e) => {
        e.preventDefault() 
        // console.log(e.target, "new target")
            var name = e.target.name
            if(name !== "replybutton"){
                this.setState({
                    ...this.state,
                    [name]: e.target.value,
                    isEdit: true,
                    thisButtonClicked: true,
                })
            }
            else {
                this.setState({
                    reply: !this.state.reply
                })
            }
        }


    onEditHandeler = (e)  => {
        // console.log("clicked this input" )
        var name = e.target.name 
        this.setState({
            ...this.state,
            [name]: e.target.value,
            thisButtonClicked: true,
            isEditing: true
        })
    }

    static getDerivedStateFromProps(nextProps, prevState){
    //    console.log(prevState, "this is before")

        if(prevState.isEditing === false ){
            // console.log("next props",nextProps)
            return {
                comment: nextProps.comment.comment,
                // id: nextProps.comment.id,
                index: nextProps.comment.index
            }
        }
        return null
    }

    sendNewObj = (e) => {
        e.preventDefault()
        if(this.state.comment !== ""){
            this.props.editHandler({
                comment: this.state.comment,
            },  this.props.index)

                this.setState({
                thisButtonClicked: false,
            })
        }
        else alert("enter item")
    }
}


// export default OneComment